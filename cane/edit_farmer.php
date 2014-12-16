<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	setcookie(remember_me,"",time()-100);
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "false";
 if(!isset($_COOKIE['remember_me']))
 {
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($UserName, $UserGroup) { 
 
  $isValid = False; 

  if (!empty($UserGroup)) { 
     
    if ($UserGroup=="Admin" || $UserGroup=="for farmer") { 
      $isValid = true; 
    } 
    
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized( $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
}
else $_SESSION['MM_Username']=$_COOKIE['remember_me'];
?>

<?php
include_once('Connections/lalo.php');
	mysql_select_db($database_lalo, $lalo);
 function renderForm($id, $firstname, $lastname,$gender,$dd,$mm,$yy,$ft,$email,$add,$vn,$vc,$zn,$zc,$ta,$tc,$di,$pn,$mn,$b,$bn,$ifsc,$error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">

        <!--custom style-->
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 


 <div class="row centered-form">
            	<div class="col-sm-9 column">
                <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registration</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="" method="post">
								
								
							<input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="" class="form-control input-sm" placeholder="First Name" required autofocus value="<?php echo $firstname; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
											
                                             
                                            <input type="text"  name="last_name" id="" class="form-control input-sm" placeholder="Last Name" required  value="<?php echo $lastname; ?>">
                                        </div>
                                    </div>
                                </div>
										<div class="row">
									<div class="col-md-12">	
										<div class="form-group">									
											<label for="birthdate">Birthdate</label>
										</div>
									</div>
                                    <div class="col-md-3">	
										<div class="form-group">
												<select id="mm" name="mm" class="form-control" required>
													<option value="">Month</option>
													<option>1</option><option>2</option><option>3</option>
													<option>4</option><option>5</option><option>6</option>
													<option>7</option><option>8</option><option>9</option>
													<option>10</option><option>11</option><option>12</option>									
												</select>
										</div>
									</div>
									<div class="col-md-3">	
										<div class="form-group">
												<select id="dd" name="dd" class="form-control" required>
													<option value="">Day</option>
													<option>1</option><option>2</option><option>3</option>
													<option>4</option><option>5</option><option>6</option>
													<option>7</option><option>8</option><option>9</option>
													<option>10</option><option>11</option><option>12</option>
													<option>13</option><option>14</option><option>15</option>
													<option>16</option><option>17</option><option>18</option>
													<option>19</option><option>20</option><option>21</option>
													<option>21</option><option>22</option><option>23</option>
													<option>24</option><option>25</option><option>26</option>
													<option>27</option><option>28</option><option>29</option>
													<option>30</option><option>31</option>					
												</select>
										</div>
									</div>
									<div class="col-md-3">	
										<div class="form-group">
												<select id="yy" name="yy" class="form-control" required>
													<option value="">Year</option>
													<option>2014</option><option>2013</option><option>2012</option>
													<option>2011</option><option>2010</option><option>2009</option>
													<option>2008</option><option>2007</option><option>2006</option>
													<option>2005</option><option>2004</option><option>2003</option>
													<option>2002</option><option>2001</option><option>2000</option>
													<option>1999</option><option>1998</option><option>1997</option>
													<option>1996</option><option>1995</option><option>1994</option>
													<option>1993</option><option>1992</option><option>1991</option>
													<option>1990</option><option>1989</option><option>1988</option>
													<option>1987</option><option>1986</option><option>1985</option>
													<option>1984</option><option>1983</option><option>1982</option>
													<option>1981</option><option>1980</option><option>1979</option>
													<option>1978</option><option>1977</option><option>1976</option>
													<option>1975</option><option>1974</option><option>1973</option>
													<option>1972</option><option>1971</option><option>1970</option>
													<option>1969</option><option>1968</option><option>1967</option>
													<option>1966</option><option>1965</option><option>1964</option>
													<option>1963</option><option>1962</option><option>1961</option>
													<option>1960</option><option>1959</option><option>1958</option>
													<option>1957</option><option>1956</option><option>1955</option>
													<option>1954</option><option>1953</option><option>1952</option>
													<option>1951</option><option>1950</option><option>1949</option>
													<option>1948</option><option>1947</option><option>1946</option>
													<option>1945</option><option>1944</option><option>1943</option>
													<option>1942</option><option>1941</option><option>1940</option>
													<option>1949</option><option>1948</option><option>1947</option>
													<option>1946</option><option>1945</option><option>1944</option>
													<option>1943</option><option>1942</option><option>1941</option>
													<option>1940</option><option>1939</option><option>1938</option>
													<option>1937</option><option>1936</option><option>1935</option>
													<option>1934</option><option>1933</option><option>1932</option>
													<option>1931</option><option>1930</option><option>1929</option>
													<option>1928</option><option>1927</option><option>1926</option>
													<option>1925</option><option>1924</option><option>1923</option>
													<option>1922</option><option>1921</option><option>1920</option>
																
												</select>	
										</div>
									</div>
								</div>
								
								<div class="row">
                                    <div class="col-md-3">	
										<div class="form-group">
											<label for="gender">Gender</label>
									
												<select id="gender" name="gender" class="form-control" required>
													<option>Male</option>
													<option>Female</option>
										
												</select>
										</div>
									</div>
									<div class="col-md-3">	
										<div class="form-group">
											<label for="Farmer Type">Farmer Type</label>
									
												<select id="ft" name="ft" class="form-control" required>
													<option>regular</option>
													<option>nominal</option>
										
												</select>
										</div>
									</div>
								</div>	
								 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Address">Address</label>
											<textarea name="add" class="form-control" rows="4" columns="6"><?php echo $add; ?></textarea>

											</div>
										</div>
									</div>
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vilage name">vilage name</label>
                                            <input type="text" name="vilage_name" id="" class="form-control input-sm" placeholder="vilage name" required value="<?php echo $vn; ?>">
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" village-code"> village-code</label>
                                            <input type="text" name="village_code" id="" class="form-control input-sm" placeholder="village-code" required value="<?php echo $vc; ?>">
                                        </div>
                                    </div>

									</div>
									
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=" Zone-name"> Zone-name</label>
                                            <input type="text" name="zone_name" id="" class="form-control input-sm" placeholder="Zone name" required value="<?php echo $zn; ?>">
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" Zone-code"> Zone-code</label>
                                            <input type="text" name="zone_code" id="" class="form-control input-sm" placeholder="Zone code" required value="<?php echo $zc; ?>">
                                        </div>
                                    </div>
									</div>

									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Taluka">Taluka</label>
                                            <input type="text" name="taluka" id="" class="form-control input-sm" placeholder="Taluka" required value="<?php echo $ta; ?>">
                                        </div>
                                    </div>
									 <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Taluka-code">Taluka-code</label>
                                            <input type="text" name="taluka_code" id="" class="form-control input-sm" placeholder="Taluka-code" required value="<?php echo $tc; ?>">
                                        </div>
                                    </div>
																		
                                    </div>
									<div class="row">
									<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="District">District</label>
                                             
                                            <input type="text"  name="district" id="" class="form-control input-sm" placeholder="District" required value="<?php echo $di; ?>">
                                        </div>
                                    </div>
									</div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Ph.No">Ph.No</label>
                                            <input type="text" name="ph_no" id="" class="form-control input-sm" placeholder="phone Number" required value="<?php echo $pn; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mo.No.">Mo.No.</label>
                                             
                                            <input type="text"  name="mo_no" id="" class="form-control input-sm" placeholder="Mobile number" required  value="<?php echo $mn; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="" class="form-control input-sm" placeholder="Email" required value="<?php echo $email; ?>">
                                </div>
								
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group controls">
                                        	<div class="control-group">
                                            <label for="Bank">Bank</label>
											<select id="first-choice" class="form-control" required>
													<option value="">Please Select</option>
													<option value="SBI">State Bank of India (SBI)</option>
													<option value="AXIS">AXIS Bank</option>
													<option value="ICICI">ICICI Bank</option>
													<option value="BOI">Bank Of India (BOI)</option>
													<option value="SDCO">SURAT DIST CO.& OP.</option>
													<option value="BOB">BOB:Bank of Baroda (BOB)</option>
																						
												</select>
 	                                        <p class="help-block"></p>
    								</div>
                                    </div>
                                    </div>
                                </div>
								
								<div class="row">
								<div class="col-md-6">
                                        <div class="form-group">
                                        	<div class="control-group">
                                            <label for="branch">branch</label>
                                         <select id="second-choice" class="form-control" required>
										<?php
	include_once('Connections/lalo.php');
	mysql_select_db($database_lalo, $lalo);
	$choice = $b;
	
	$query3 = "SELECT branch_name FROM branches WHERE bank_name='$choice'";
	
	$result3 = mysql_query($query3);
		echo "<option value=''>--select--</option>";
	while ($row3 = mysql_fetch_array($result3)) {
   		 echo "<option value='" . $row3['branch_name'] . "'>" . $row3['branch_name'] . "</option>";
	}
?>
										</select>
                                            	</div></div>
									</div>
									
									<div class="col-md-6">
                                        <div class="form-group">
                                        	<div class="control-group">
                                            <label for="IFSC">IFSC</label>
                                            <select name="ifsc" id="third-choice" class="form-control" required>
										<option ><?php echo $ifsc; ?></option>
										</select>
    								</div></div>
									</div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">
                                    </div>
                                    <div class="col-md-6">
                                       <a class="btn btn-primary btn-block" href="view_farmer.php" role="button">Cancel</a>  
                                    </div>
                                </div>
                             

                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		 

<script type="text/javascript">

var gen= document.getElementById( 'gender' ),i = gen.options.length - 1; 
        for ( ; i > -1 ; i-- ) {

        if ( gen.options[i].value == "<?php echo $gender; ?>") {
            gen.options[i].selected = true;
            break;
        } 
        }var mm= document.getElementById( 'mm' ),j = mm.options.length - 1; 
        for ( ; j > -1 ; j-- ) {

        if ( mm.options[j].value == "<?php echo $mm; ?>" ) {
            mm.options[j].selected = true;
            break;
        }}
        var dd= document.getElementById( 'dd' ),k = dd.options.length - 1;
        for ( ; k > -1 ; k-- ) {

        if ( dd.options[k].value == "<?php echo $dd; ?>") {
            dd.options[k].selected = true;
            break;
        }}
        var yy= document.getElementById( 'yy' ),l = yy.options.length - 1;
        for ( ; l > -1 ; l-- ) {

        if ( yy.options[l].value == "<?php echo $yy; ?>" ) {
            yy.options[l].selected = true;
            break;
        }
        }
        var ft= document.getElementById( 'ft' ),m = ft.options.length - 1;
        for ( ; m > -1 ; m-- ) {

        if ( ft.options[m].value == "<?php echo $ft; ?>" ) {
            ft.options[m].selected = true;
            break;
        }

    }
     var b= document.getElementById( 'first-choice' ),x = b.options.length - 1;
        for ( ; x > -1 ; x-- ) {

        if ( b.options[x].value == "<?php echo $b; ?>" ) {
            b.options[x].selected = true;
            break;
        }
        }
         var bb= document.getElementById( 'second-choice' ),l = bb.options.length - 1;
        for ( ; l > -1 ; l-- ) {

        if ( bb.options[l].value == "<?php echo $bn; ?>" ) {
            bb.options[l].selected = true;
            break;
        }
        }
     
   
       </script>
       <script src="js/jqBootstrapValidation.js"></script>
		<script>
  		$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
		</script>
        <script>$("#first-choice").change(function() {
	$("#second-choice").load("getter.php?choice=" + $("#first-choice").val());
});</script>
<script>
$("#second-choice").change(function() {
	$("#third-choice").load("getter2.php?choice=" + encodeURIComponent($("#second-choice").val()));
});</script>
 </body>
 </html> 
 <?php
 }



 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$emai=$_POST['email'];

$gender=$_POST['gender'];
$date = $_POST['yy'] . '-' . $_POST['mm'] . '-' . $_POST['dd'];

$ut1=$_POST['ft'];
 $add=$_POST['add'];
$vn=$_POST['vilage_name'];
$vc=$_POST['village_code'];
$zn=$_POST['zone_name'];
$zc=$_POST['zone_code'];
$ta=$_POST['taluka'];
$tc=$_POST['taluka_code'];
$di=$_POST['district'];
$pn=$_POST['ph_no'];
$mn=$_POST['mo_no'];

$if=$_POST['ifsc'];
 
 // save the data to the database
 mysql_query("UPDATE farmers SET firstname='$fname', lastname='$lname', email='$emai', gender='$gender',birthdate= '$date', farmer_type='$ut1',address='$add',village_name='$vn',village_code='$vc',zone_name='$zn',zone_code='$zc',taluka='$ta',taluka_code='$tc',district='$di',ph_no='$pn',mo_no='$mn',ifsc='$if' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view_farmer.php"); 
 
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM farmers WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];

 $email=$row['email'];
 $gender=$row['gender'];
 $birthdate=$row['birthdate'];
 $ft=$row['farmer_type'];
 $birarray = explode("-",$birthdate);
 $yy=$birarray[0];
 $mm=$birarray[1];
 $dd=$birarray[2];
 if($mm<10&&$mm>0)
 $mm=$mm[1];
  if($dd<10&&$dd>0)
 $dd=$dd[1];
$add=$row['address'];
$vn=$row['village_name'];
$vc=$row['village_code'];
$zn=$row['zone_name'];
$zc=$row['zone_code'];
$ta=$row['taluka'];
$tc=$row['taluka_code'];
$di=$row['district'];
$pn=$row['ph_no'];
$mn=$row['mo_no'];
$ifsc=$row['ifsc'];
$result1 = mysql_query("SELECT * FROM branches WHERE ifsc='$ifsc'")
 or die(mysql_error()); 
 $row1 = mysql_fetch_array($result1);
 $b=$row1['bank_name'];
  $bn=$row1['branch_name'];
 // show form
 renderForm($id, $firstname, $lastname,$gender,$dd,$mm,$yy,$ft,$email,$add,$vn,$vc,$zn,$zc,$ta,$tc,$di,$pn,$mn,$b,$bn,$ifsc,'');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>
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
     
    if ($UserGroup=="Admin") { 
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
 function renderForm($id, $firstname, $lastname,$username,$gender,$dd,$mm,$yy,$ut,$email,$error)
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
                                            <input type="text" name="first_name" id="" class="form-control input-sm" placeholder="First Name" required autofocus  value="<?php echo $firstname; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                             
                                            <input type="text"  name="last_name" id="" class="form-control input-sm" placeholder="Last Name" required value="<?php echo $lastname; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                		<div class="control-group">
                                    <label class="control-label" for="email">Email</label>
                                    <div class="controls"><input type="email" name="email" id="" class="form-control input-sm" placeholder="Email" required value="<?php echo $email; ?>">
                                	<p class="help-block"></p>
                                	</div></div>
                                </div>
								<div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="" class="form-control input-sm" placeholder="username" required value="<?php echo $username; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group controls">
                                        	<div class="control-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password"  data-validation-pas-regex="((?=.*\d)(?=.*[A-Z]).{8,20})" 
        data-validation-pas-message=" must contain at least one digit and one uppercase character, length must between 8 to 20" 
         id="" class="form-control input-sm" placeholder="Password"  >
                                         <p class="help-block"></p>
    </div> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        	<div class="control-group">
                                            <label for="password">Confirm Password</label>
                                            <input type="password" data-validation-match-match="password" name="password_confirmation" id="" class="form-control input-sm" placeholder="Confirm Password"  >
                                        <p class="help-block"></p>
    								</div></div>
                                    </div>
                                </div>
								
	
								<div class="row">
                                    <div class="col-md-3">	
										<div class="form-group">
											<label for="gender">Gender</label>
									
												<select id="gender" name="gen"class="form-control" required>
													<option>Male</option>
													<option>Female</option>
										
												</select>
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
											
												<select id="mm" name="dob_month" class="form-control" required>
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
												<select id="dd" name="dob_day" class="form-control" required>
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
												<select id="yy" name="dob_year" class="form-control" required>
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
                                    <div class="col-md-12">	
										<div class="form-group">
											<label for="user_level">Select User Type</label>
									
												<select id="ut" name="ut" class="form-control">
													<option>Admin</option>
													<option>for Transport</option>
													<option>for farmer</option>
													<option>for weight</option>
												</select>
										</div>
									</div>
								</div>
								
								
														
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-primary btn-block" href="view.php" role="button">Cancel</a>  
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
        var ut= document.getElementById( 'ut' ),m = ut.options.length - 1;
        for ( ; m > -1 ; m-- ) {

        if ( ut.options[m].value == "<?php echo $ut; ?>" ) {
            ut.options[m].selected = true;
            break;
        }

    }
   
       </script>
       <script src="js/jqBootstrapValidation.js"></script>
		<script>
  		$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
		</script>
        
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
$un=$_POST['username'];

if($_POST['password']=="")
{$result = mysql_query("SELECT password FROM members WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 $ps=$row['password'];
}
 else{
$ps=md5($_POST['password']);
 }
$gender=$_POST['gen'];
$date = $_POST['dob_year'] . '-' . $_POST['dob_month'] . '-' . $_POST['dob_day'];
$today1 = date("Y-m-d H:i:s.u");
$ut1=$_POST['ut'];
 
 
 // save the data to the database
 mysql_query("UPDATE members SET firstname='$fname', lastname='$lname',username='$un',password='$ps', email='$emai', gender='$gender',birthdate= '$date', user_type='$ut1',date= '$today1' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 
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
 $result = mysql_query("SELECT * FROM members WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 $username = $row['username'];
 $email=$row['email'];
 $gender=$row['gender'];
 $birthdate=$row['birthdate'];
 $ut=$row['user_type'];
 $birarray = explode("-",$birthdate);
 $yy=$birarray[0];
 $mm=$birarray[1];
 $dd=$birarray[2];
 if($mm<10&&$mm>0)
 $mm=$mm[1];
  if($dd<10&&$dd>0)
 $dd=$dd[1];
 
 // show form
 renderForm($id, $firstname, $lastname,$username,$gender,$dd,$mm,$yy,$ut,$email,'');
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
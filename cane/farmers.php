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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sugar-cane</title>
         
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">

        <!--custom style-->
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css">

       

    </head>
    <body>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    
                    <a class="navbar-brand" href="#">Sugar Cane</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $_SESSION['MM_Username']; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="setting.php"><span class="glyphicon glyphicon-cog"></span> Setting</a>
                                </li>
                               
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo $logoutAction ?>"> <span class="glyphicon glyphicon-off"></span> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container-fluid">
            <div class="row clearfix" style="padding-bottom: 10px;">
                <div class="col-sm-2 column">
                    
                    </div>
               <div class="col-md-6 col-md-offset-1">
 <a class="btn btn-success" href="farmers.php" role="button">Add New</a>  
  
<a class="btn btn-success" href="view_farmer.php" role="button">View</a>                 

<br/>
				
             
                </div>
                <form method="get" action="view_farmer.php">
                <div class="col-sm-3 column">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search farmer">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default" >
                                Search 
                            </button>
                          
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                </div>
                </form>
            </div>
            <div class="row clearfix">
                <div class="col-md-2 column">

                    <ul class="nav nav-pills nav-stacked">
                        <li >
                            <a href="dashboard.php">Manage user</a>
                        </li>
                        <li>
                            <a href="transportation.php">Transportation</a>
                        </li>
                        <li class="active">
                            <a href="farmers.php">Farmers</a>
                        </li>
                         <li>
                            <a href="weight.php">Weight</a>
                        </li>
						<li>
                            <a href="application.php"><span class="badge badge-danger pull-right"><?php include_once 'Connections/not.php'; echo"$n";?></span>Applications</a>
                        </li>
                    </ul>
                </div>
                <?php if (isset($_GET['dsent'])) echo "<div id='lal'> </div>";  ?>
                  <div class="container" style="margin-top: 5px; margin-left: 5px;">

            <div class="row centered-form">
            	<div class="col-sm-9 column">
                <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registration</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="add_farmer.php" method="post">
								
								
							
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="" class="form-control input-sm" placeholder="First Name" required autofocus >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
											
                                             
                                            <input type="text"  name="last_name" id="" class="form-control input-sm" placeholder="Last Name" required >
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
												<select name="mm" class="form-control" required>
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
												<select name="dd" class="form-control" required>
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
												<select name="yy" class="form-control" required>
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
									
												<select name="gender" class="form-control" required>
													<option>Male</option>
													<option>Female</option>
										
												</select>
										</div>
									</div>
									<div class="col-md-3">	
										<div class="form-group">
											<label for="Farmer Type">Farmer Type</label>
									
												<select name="ft" class="form-control" required>
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
											<textarea name="add" class="form-control" rows="4" columns="6"></textarea>

											</div>
										</div>
									</div>
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vilage name">vilage name</label>
                                            <input type="text" name="vilage_name" id="" class="form-control input-sm" placeholder="vilage name" required>
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" village-code"> village-code</label>
                                            <input type="text" name="village_code" id="" class="form-control input-sm" placeholder="village-code" required>
                                        </div>
                                    </div>

									</div>
									
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=" Zone-name"> Zone-name</label>
                                            <input type="text" name="zone_name" id="" class="form-control input-sm" placeholder="Zone name" required>
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" Zone-code"> Zone-code</label>
                                            <input type="text" name="zone_code" id="" class="form-control input-sm" placeholder="Zone code" required>
                                        </div>
                                    </div>
									</div>

									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Taluka">Taluka</label>
                                            <input type="text" name="taluka" id="" class="form-control input-sm" placeholder="Taluka" required>
                                        </div>
                                    </div>
									 <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Taluka-code">Taluka-code</label>
                                            <input type="text" name="taluka_code" id="" class="form-control input-sm" placeholder="Taluka-code" required>
                                        </div>
                                    </div>
																		
                                    </div>
									<div class="row">
									<div class="col-md-6">
                                        <div class="form-group">
                                            <label for="District">District</label>
                                             
                                            <input type="text"  name="district" id="" class="form-control input-sm" placeholder="District" required >
                                        </div>
                                    </div>
									</div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Ph.No">Ph.No</label>
                                            <input type="text" name="ph_no" id="" class="form-control input-sm" placeholder="phone Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Mo.No.">Mo.No.</label>
                                             
                                            <input type="text"  name="mo_no" id="" class="form-control input-sm" placeholder="Mobile number" required >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="" class="form-control input-sm" placeholder="Email" required >
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
										<option  value="">Please choose from above</option>
										</select>
                                            	</div></div>
									</div>
									
									<div class="col-md-6">
                                        <div class="form-group">
                                        	<div class="control-group">
                                            <label for="IFSC">IFSC</label>
                                            <select name="ifsc" id="third-choice" class="form-control" required>
										<option  value="">Please choose from above</option>
										</select>
    								</div></div>
									</div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" value="Submit" class="btn btn-primary btn-block">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="reset" value="Reset" class="btn btn-default btn-block">
                                    </div>
                                </div>
                             

                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		</div>
            </div>
            <hr>

            <footer>
                <p class="text-muted">
                    &copy; 2014 SCMS Solution by Lalji ,Ujjaval and Mohit.
                </p>
            </footer>
        </div>
        <script src="js/jqBootstrapValidation.js"></script>
		<script>
  		$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
		</script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script>$("#first-choice").change(function() {
	$("#second-choice").load("getter.php?choice=" + $("#first-choice").val());
});</script>
<script>
$("#second-choice").change(function() {
	$("#third-choice").load("getter2.php?choice=" + encodeURIComponent($("#second-choice").val()));
});</script>

      <script>function showAlert(containerId, alertType, message) {
    $("#" + containerId).append('<div class="col-md-3 col-md-offset-1"><div class="alert alert-' + alertType + '" id="alert' + containerId + '">' + message + '</div></div>');
    $("#alert" + containerId).alert();
    window.setTimeout(function () { $("#alert" + containerId).alert('close'); }, 2000);
}showAlert('lal','success','Added Successfully');</script>  
    </body>
</html>
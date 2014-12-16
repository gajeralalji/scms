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


$MM_restrictGoTo = "login.php";
if (!isset($_SESSION['MM_Username'])){   
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

if(isset($_POST['opassword']))
{
	include_once('Connections/lalo.php');
		mysql_select_db($database_lalo, $lalo);
  $un=$_SESSION['MM_Username'];
  $query="SELECT password FROM members WHERE username='$un'"; 
   
  $ll = mysql_query($query, $lalo) or die(mysql_error());
  $dp = mysql_fetch_assoc($ll);
  $pas1=md5($_POST['password']);
	if(md5($_POST['opassword'])==$dp['password'])
	{
		$query3 = mysql_query("update members set password='$pas1' where username='$un'");
		header("Location:setting.php?pc=1");
		
	}
	else {
		header("Location:setting.php?rp=1");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sugar-cane</title>
         
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
               						
		
                </div>								
									
               
            <div class="row clearfix">
                <div class="col-md-2 column">

                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="dashboard.php">Manage user</a>
                        </li>
                        <li>
                            <a href="transportation.php">Transportation</a>
                        </li>
                        <li>
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
                <?php if (isset($_GET['pc'])) echo "<div id='lal'> </div>"; 
else if(isset($_GET['rp'])){ echo "<div class='col-md-3 col-md-offset-1''><div class='alert alert-danger''>Old password doesn't match</div></div> ";
}
				 ?>
                  <div class="container" style="margin-top: 5px; margin-left: 5px;">

            <div class="row centered-form">
            	<div class="col-sm-9 column">
                <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center">Change Password</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="setting.php" method="post">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group controls">
                                        	<div class="control-group">
                                            <label for="password">Old Password</label>
                                            <input type="password" name="opassword"  class="form-control input-sm" placeholder="Old Password" required >
                                         
    </div> </div>
                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group controls">
                                        	<div class="control-group">
                                            <label for="password">New Password</label>
                                            <input type="password" name="password"  data-validation-pas-regex="((?=.*\d)(?=.*[A-Z]).{8,20})" 
        data-validation-pas-message=" must contain at least one digit and one uppercase character, length must between 8 to 20" 
         id="" class="form-control input-sm" placeholder="New Password" required >
                                         <p class="help-block"></p>
    </div> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        	<div class="control-group">
                                            <label for="password">Confirm Password</label>
                                            <input type="password" data-validation-match-match="password" name="password_confirmation" id="" class="form-control input-sm" placeholder="Confirm Password" required >
                                        <p class="help-block"></p>
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
        
        <script>function showAlert(containerId, alertType, message) {
    $("#" + containerId).append('<div class="col-md-3 col-md-offset-1"><div class="alert alert-' + alertType + '" id="alert' + containerId + '">' + message + '</div></div>');
    $("#alert" + containerId).alert();
    window.setTimeout(function () { $("#alert" + containerId).alert('close'); }, 2000);
}showAlert('lal','success','Password changed Successfully');</script>

        <script src="js/jqBootstrapValidation.js"></script>
		<script>
  		$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
		</script>
        
    </body>
</html>
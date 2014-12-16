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
     
    if ($UserGroup=="Admin" || $UserGroup=="for weight") { 
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
 <a class="btn btn-success" href="weight.php" role="button">Add New</a>  

<a class="btn btn-success" href="view_weight.php" role="button">View</a>                 

<br/>
				
             
                </div>
               <form method="get" action="view_weight.php">
                <div class="col-sm-3 column">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control" placeholder="Search user">
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
                        <li >
                            <a href="farmers.php">Farmers</a>
                        </li>
                         <li class="active">
                            <a href="view_weight.php">Weight</a>
                        </li>
						<li>
                            <a href="application.php"><span class="badge badge-danger pull-right"><?php include_once 'Connections/not.php'; echo"$n";?></span>Applications</a>
                        </li>
                    </ul>
                </div>
                  <div class="container" style="margin-top: 5px; margin-left: 5px;">
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
                            <form role="form" method="post" action="add_weight.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Weighment ticket code</label>
                                            <input type="text" name="wtc" id="" class="form-control input-sm" placeholder="Weighment ticket code" required autofocus >
                                        </div>
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Cutting Order Code</label>
											
                                             
                                            <input type="text"  name="coc" id="" class="form-control input-sm" placeholder="Cutting Order Code" required >
                                        </div>
										</div>                                    
									
                                    <div class="col-md-3">	
										<div class="form-group">
											<label for="Vehicle Type">Vehicle Type</label>
									
												<select name="vt" class="form-control" required>
													<option>Truck</option>
													<option>Trackter</option>
													<option>Bull-Cart</option>
										
												</select>
										</div>
									
                                </div>
								</div>
										<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ID Number">ID Number</label>
                                            <input type="number" name="id" id="id" class="form-control input-sm" placeholder="ID Number" required>
                                        </div>
                                    </div>
									
								

										
									<div class="col-md-6">	
										<div class="form-group">									
											<label for="">First Name</label>
											<input readonly="" type="text"  name="fn" id="first_name" class="form-control input-sm" placeholder="First Name" required >
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-md-6">	
										<div class="form-group">									
											<label for="">Last Name </label>
											<input readonly="" type="text"  name="ln" id="last_name" class="form-control input-sm" placeholder="Last Name" required >
										</div>
									</div>
									</div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vilage code">village Name</label>
                                            <input readonly="" type="text" name="vn" id="vn" class="form-control input-sm" placeholder="village Name" required>
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" village-code"> village-code</label>
                                            <input readonly="" type="text" name="vc" id="vc" class="form-control input-sm" placeholder="village-code" required>
                                        </div>
                                    </div>

									</div>
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=" Zone-name"> Zone-name</label>
                                            <input readonly="" type="text" name="zn" id="zn" class="form-control input-sm" placeholder="Zone name" required>
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" Zone-code"> Zone-code</label>
                                            <input readonly="" type="text" name="zc" id="zc" class="form-control input-sm" placeholder="Zone code" required>
                                        </div>
                                    </div>
									</div>

									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Taluka">Taluka</label>
                                             
                                            <input readonly="" type="text"  name="ta" id="ta" class="form-control input-sm" placeholder="Taluka" required >
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" Taluka-code"> Taluka-code</label>
                                            <input readonly="" type="text" name="tc" id="tc" class="form-control input-sm" placeholder="Taluka-code" required>
                                        </div>
                                    </div>

                                </div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="District">District</label>
                                            <input readonly="" type="text" name="di" id="di" class="form-control input-sm" placeholder="District" required>
                                        </div>
                                    </div>
									
									</div>
									
									
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Weight with vehicle"> Weight with vehicle</label>
                                            <input type="text" name="wwv" id="" class="form-control input-sm" placeholder="Weight with vehicle" required>
                                        </div>
                                    </div>
									 <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Net Weight"> Net Weight</label>
                                            <input type="text" name="nw" id="" class="form-control input-sm" placeholder="Net Weight" required>
                                        </div>
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
       
        <script>
$("#id").on("focusout", function () {
   var $self = $(this); // We create an jQuery object with the select inside
                $.post("getter3.php", { id : $self.val()}, function(json) {
                    if (json && json.status) {
                        $('#first_name').val(json.name);
                        $('#last_name').val(json.lastname);
                        $('#vn').val(json.vn);
                        $('#vc').val(json.vc);
                        $('#zn').val(json.zn);
                        $('#zc').val(json.zc);
                        $('#ta').val(json.ta);
                        $('#tc').val(json.tc);
                        $('#di').val(json.di);
                    }
                })
});</script>

        <script>function showAlert(containerId, alertType, message) {
    $("#" + containerId).append('<div class="col-md-3 col-md-offset-1"><div class="alert alert-' + alertType + '" id="alert' + containerId + '">' + message + '</div></div>');
    $("#alert" + containerId).alert();
    window.setTimeout(function () { $("#alert" + containerId).alert('close'); }, 2000);
}showAlert('lal','success','Added Successfully');</script>   
    </body>
</html>
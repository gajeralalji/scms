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

<?php
include_once('Connections/lalo.php');
	mysql_select_db($database_lalo, $lalo);
 function renderForm($tc1,$coc,$vt,$id1,$wv,$nw,$fn,$ln,$vn,$vc,$zn,$zc,$ta,$tc,$di)
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

 


 <div class="row centered-form">
            	<div class="col-sm-9 column">
                <div class="col-md-8 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registration</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Weighment ticket code</label>
                                            <input readonly="" type="text" value="<?php echo"$tc1"; ?>" name="wtc" id="" class="form-control input-sm" placeholder="Weighment ticket code" required autofocus >
                                        </div>
                                    </div>
									</div>
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Cutting Order Code</label>
											
                                             
                                            <input type="text" value="<?php echo"$coc"; ?>"  name="coc" id="" class="form-control input-sm" placeholder="Cutting Order Code" required >
                                        </div>
										</div>                                    
									
                                    <div class="col-md-3">	
										<div class="form-group">
											<label for="Vehicle Type">Vehicle Type</label>
									
												<select id="vt" name="vt" class="form-control" required>
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
                                            <input value="<?php echo"$id1"; ?>" type="number" name="id" id="id" class="form-control input-sm" placeholder="ID Number" required>
                                        </div>
                                    </div>
									
								

										
									<div class="col-md-6">	
										<div class="form-group">									
											<label for="">First Name</label>
											<input value="<?php echo"$fn"; ?>" readonly="" type="text"  name="fn" id="first_name" class="form-control input-sm" placeholder="First Name" required >
										</div>
									</div>
								</div>
								<div class="row">
								<div class="col-md-6">	
										<div class="form-group">									
											<label for="">Last Name </label>
											<input value="<?php echo"$ln"; ?>" readonly="" type="text"  name="ln" id="last_name" class="form-control input-sm" placeholder="Last Name" required >
										</div>
									</div>
									</div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vilage code">village Name</label>
                                            <input value="<?php echo"$vn"; ?>"readonly="" type="text" name="vn" id="vn" class="form-control input-sm" placeholder="village Name" required>
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" village-code"> village-code</label>
                                            <input value="<?php echo"$vc"; ?>" readonly="" type="text" name="vc" id="vc" class="form-control input-sm" placeholder="village-code" required>
                                        </div>
                                    </div>

									</div>
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=" Zone-name"> Zone-name</label>
                                            <input value="<?php echo"$zn"; ?>"  readonly="" type="text" name="zn" id="zn" class="form-control input-sm" placeholder="Zone name" required>
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" Zone-code"> Zone-code</label>
                                            <input  value="<?php echo"$zc"; ?>"  readonly="" type="text" name="zc" id="zc" class="form-control input-sm" placeholder="Zone code" required>
                                        </div>
                                    </div>
									</div>

									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Taluka">Taluka</label>
                                             
                                            <input value="<?php echo"$ta"; ?>"   readonly="" type="text"  name="ta" id="ta" class="form-control input-sm" placeholder="Taluka" required >
                                        </div>
                                    </div>
									<div class="col-md-3">
                                        <div class="form-group">
                                            <label for=" Taluka-code"> Taluka-code</label>
                                            <input value="<?php echo"$tc"; ?>"   readonly="" type="text" name="tc" id="tc" class="form-control input-sm" placeholder="Taluka-code" required>
                                        </div>
                                    </div>

                                </div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="District">District</label>
                                            <input value="<?php echo"$di"; ?>"   readonly="" type="text" name="di" id="di" class="form-control input-sm" placeholder="District" required>
                                        </div>
                                    </div>
									
									</div>
									
									
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Weight with vehicle"> Weight with vehicle</label>
                                            <input value="<?php echo"$wv"; ?>"  type="text" name="wwv" id="" class="form-control input-sm" placeholder="Weight with vehicle" required>
                                        </div>
                                    </div>
									 <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="Net Weight"> Net Weight</label>
                                            <input value="<?php echo"$nw"; ?>"   type="text" name="nw" id="" class="form-control input-sm" placeholder="Net Weight" required>
                                        </div>
                                    </div>
									
									</div>
							
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block">
                                    </div>
                                   <div class="col-md-6">
                                        <a class="btn btn-primary btn-block" href="view_weight.php" role="button">Cancel</a>  
                                    </div>
                                </div>
                             

                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
<script type="text/javascript">

var vt= document.getElementById( 'vt' ),i = vt.options.length - 1; 
        for ( ; i > -1 ; i-- ) {

        if ( vt.options[i].value == "<?php echo $vt; ?>") {
            vt.options[i].selected = true;
            break;
        } 
        }
   </script>
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
 <?php
 }



 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
$wtc=$_POST['wtc'];
$coc=$_POST['coc'];
$vt=$_POST['vt'];
$id=$_POST['id'];
$wwv=$_POST['wwv'];
$nw=$_POST['nw'];

 
 // save the data to the database
 mysql_query("UPDATE `weight` SET `cutting_order_code`='$coc',`vehicle_type`='$vt',`id`='$id',`weight_vehicle`='$wwv',`net_weight`='$nw' WHERE ticket_code='$wtc'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view_weight.php"); 
 
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
 $result = mysql_query("SELECT * FROM weight WHERE ticket_code=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
  $tc1 = $row['ticket_code'];
  $coc = $row['cutting_order_code'];
  $vt = $row['vehicle_type'];
  $id1 = $row['id'];
  $wv = $row['weight_vehicle'];
  $nw = $row['net_weight'];
   $result1 = mysql_query("SELECT * FROM farmers WHERE id=$id1")
 or die(mysql_error()); 
 $row1 = mysql_fetch_array($result1);
 $fn = $row1['firstname'];
$ln = $row1['lastname'];
$vn=$row1['village_name'];
$vc=$row1['village_code'];
$zn=$row1['zone_name'];
$zc=$row1['zone_code'];
$ta=$row1['taluka'];
$tc=$row1['taluka_code'];
$di=$row1['district'];

 // show form
 renderForm($tc1,$coc,$vt,$id1,$wv,$nw,$fn,$ln,$vn,$vc,$zn,$zc,$ta,$tc,$di);
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
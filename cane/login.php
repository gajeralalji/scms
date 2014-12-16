<?php require_once('Connections/lalo.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_SESSION['MM_UserGroup']))
{
   $loginStrGroup=$_SESSION['MM_UserGroup'];
     if($loginStrGroup=="Admin")
    header("Location:dashboard.php");
	if($loginStrGroup=="for Transport")
    header("Location: transportation.php");
    if($loginStrGroup=="for farmer")
    header("Location: farmers.php");
	if($loginStrGroup=="for weight")
    header("Location: weight.php" );
  	
   
}  
	
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $password=md5($password);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "dashboard.php";
  $MM_redirectLoginFailed = "login_error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_lalo, $lalo);
  
  $LoginRS__query=sprintf("SELECT username, password,user_type FROM members WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $lalo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
  	$lalji=mysql_fetch_assoc($LoginRS);
     $loginStrGroup = $lalji['user_type'];
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	  
	    
if($_POST['remember']) {
	$exp = time() + 604800;
setcookie('remember_me', $_POST['username'], $exp);
}
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    
    if($loginStrGroup=="Admin")
    header("Location: " . $MM_redirectLoginSuccess );
	if($loginStrGroup=="for Transport")
    header("Location: transportation.php");
    if($loginStrGroup=="for farmer")
    header("Location: farmers.php");
	if($loginStrGroup=="for weight")
    header("Location: weight.php" );
  }
  else {
	  die(header("location:login.php?loginFailed=true&reason=password"));
    //header("Location: ". $MM_redirectLoginFailed );
  }
}
if(isset($_POST['email']))
	{$email=$_POST['email'];
	mysql_select_db($database_lalo, $lalo);
	$LoginRS = mysql_query("select * from members where email='$email'", $lalo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser)
   {$code=rand(100,999);
   			
			
   $query2 = mysql_query("update members set activation_code='$code' where email='$email' ");
		$message="Your reset link is: http://localhost/cane/resetpass.php?email=$email&code=$code";
		$headers="From: localhost";
		mail($email, "password reset link",$message, $headers);
		
		
		die(header("location:login.php?emailexist=true"));
		
	}
	else{die(header("location:login.php?emailexist=false"));
	}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sugar-cane</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="js/custom_jquery.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		<a href="index.php"><img src="images/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->

	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
	<form action="<?php echo $loginFormAction; ?>" method="POST">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input type="text" name="username" class="login-inp" required=""/></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password" value=""  onfocus="this.value="" class="login-inp" required/></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" name="remember" value=1 class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
		</tr>
		<tr>
			<th></th>
 <td><input type="submit" class="submit-login"  /></td>

		</tr>
		</table><font color="#FFFFFF">
         <?php  if (isset($_GET["loginFailed"])) echo "Invalid Username or Password"; if (isset($_GET["emailexist"])){ if($_GET["emailexist"]=="true")echo "Email sent check your email to reset password"; else echo "Email doesn't exist";}?>
         </font>
	  </form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="forgot-pwd">Forgot Password?</a>
 </div>
 <!--  end loginbox -->
 
	<!--  start forgotbox ................................................................................... -->
	<div id="forgotbox">
		<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
		<!--  start forgot-inner -->
		<div id="forgot-inner">
        <form action="login.php" method="post">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="text" name="email" value=""   class="login-inp" required/></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="submit" class="submit-login"  /></td>
		</tr>
		</table>
		<font color="#FFFFFF">
        
         </font>
        </form>
		</div>
		<!--  end forgot-inner -->
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->

</div>
<!-- End: login-holder -->
</body>
</html>
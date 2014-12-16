<?php require_once('Connections/lalo.php'); 
if(isset($_GET['email']))
{	$email=$_GET['email'];
	$code=$_GET['code'];
	}
	if(isset($_POST['pas1']))
	{$pas1=md5($_POST['pas1']);
mysql_select_db($database_lalo, $lalo);
	$query= mysql_query("SELECT * From members where email='$email' AND activation_code='$code' ")or die(mysql_error());
	$numr = mysql_num_rows($query);
if($numr==1)
{$query3 = mysql_query("update members set password='$pas1' where email='$email' ");
$query3 = mysql_query("update members set activation_code=0 where email='$email' ");
echo "password updated successfully <a href='login.php'>click here</a> to login";
}
else echo "invalid link";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form id="form1" name="form1" method="post" action="resetpass.php?email=<?php echo $email; ?>&code=<?php echo$code; ?>">
  <span id="sprypassword1">
  <label for="pas2">new password</label>
  <input type="password" name="pas1" id="pas2" />
  <span class="passwordRequiredMsg">A value is required.</span></span>
  <span id="spryconfirm1">
  <label for="pas3">retype password</label>
  <input type="password" name="pas2" id="pas3" />
  <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span>
  <input type="submit" value="submit" />
</form>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "pas2");
</script>
</body>
</html>
<?php require_once('Connections/lalo.php'); ?>
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
     
    if ($UserGroup=="Admin" || $UserGroup=="for Transport") { 
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

$maxRows_users = 10;
$pageNum_users = 0;
if (isset($_GET['pageNum_users'])) {
  $pageNum_users = $_GET['pageNum_users'];
}
if (isset($_GET['jump'])) {
	
  $pageNum_users = $_GET['jump']-1;
}
$startRow_users = $pageNum_users * $maxRows_users;

mysql_select_db($database_lalo, $lalo);
if (isset($_GET['search'])) {
	$search=$_GET['search'];
$query_users = "SELECT * FROM trans where ticket_code like '%$search%' or vehicle_type like '%$search%' or vehicle_number like '%$search%' or id like '%$search%' or distance like '%$search%' or rent like '%$search%'";	
}else {
$query_users = "SELECT * FROM trans";
}
$query_limit_users = sprintf("%s LIMIT %d, %d", $query_users, $startRow_users, $maxRows_users);
$users = mysql_query($query_limit_users, $lalo) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

if (isset($_GET['totalRows_users'])) {
  $totalRows_users = $_GET['totalRows_users'];
} else {
  $all_users = mysql_query($query_users);
  $totalRows_users = mysql_num_rows($all_users);
}
$totalPages_users = ceil($totalRows_users/$maxRows_users)-1;

function paging(){
	
	global $pageNum_users;
	global $totalPages_users;
	
	if($totalPages_users != "0"){
		echo "<ul class='pagination'>";
			if($pageNum_users != "0"){
				$prev = $pageNum_users-1;
				echo "<li><a href='view_app.php?pageNum_users=$prev'>&laquo;</a></li>";
			}
			for ( $counter = 0; $counter <= $totalPages_users; $counter += 1) {
				if($counter==$pageNum_users)
				echo "<li class='active'><a href='view_app.php?pageNum_users=$counter'>";
				else	
				echo "<li><a href='view_app.php?pageNum_users=$counter'>";
				echo $counter+1;
				echo "</a></li>";
			}
			if($pageNum_users < $totalPages_users){
				$next = $pageNum_users+1;
				echo "<li><a href=\"view_app.php?pageNum_users=$next\">&raquo;</a></li>";
			}
		
		echo "</ul>";
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
 <a class="btn btn-success" href="transportation.php" role="button">Add New</a>  
    
<a class="btn btn-success" href="view_tran.php" role="button">View</a>                 
               
 <br/>
				
             
                </div>
                <form method="get" action="view_tran.php">
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
                        <li>
                            <a href="dashboard.php">Manage user</a>
                        </li>
                        <li class="active">
                            <a href="transportation.php">Transportation</a>
                        </li>
                        <li>
                            <a href="farmers.php">Farmers</a>
                        </li>
                         <li>
                            <a href="weight.php">Weight</a>
                        </li>
						<li>
                            <a href="application.php"><span class="badge badge-danger pull-right" ><?php include_once 'Connections/not.php'; echo"$n";?></span>Applications</a>
							
                        </li>
                    </ul>
                </div>
				<?php if($totalRows_users> 0) {?>
                  
			
            <div class="row centered-form">
            	<div class="col-md-8" style="margin-top: 5px; margin-left: 10px;">
                <div class="panel panel-primary">
				  <!-- Default panel contents -->
 				 <div class="panel-heading" align="center">Transportation</div>
	<div class="table-responsive">
                  <table class="table table-condensed table-striped table-bordered" >
                    <tr>
                      <td><b>Ticket code</b></td>
                     <td><b>Vehicle type</b></td>
                      <td><b>Vehicle No</b></td>
                     
                      <td><b>Owner name</b></td>
                      <td><b>Farmer Id</b></td>                      
                      <td><b>Farmer Name</b></td>
                       <td><b>Distance</b></td>
                        <td><b>rate</b></td>
                      <td><b>Action</b></td>
                     
                    </tr>
                    <?php do { ?>
                      <tr>
                        <td><?php echo $row_users['ticket_code']; ?></td>
                        <td><?php echo $row_users['vehicle_type']; ?></td>
                        <td><?php echo $row_users['vehicle_number']; ?></td>
                                       <?php $id2=$row_users['vehicle_number'];
                      $query_users2 = "SELECT * FROM vehicle where vehicle_num='$id2'";

$users2= mysql_query($query_users2, $lalo) or die(mysql_error());
$row_users2= mysql_fetch_assoc($users2);?>

                       <td><?php echo $row_users2['name']; ?></td>
                        <td><?php echo $row_users['id']; ?></td>
                       
                      <?php $id1=$row_users['id'];
                      $query_users1 = "SELECT firstname FROM farmers where id=$id1";

$users1= mysql_query($query_users1, $lalo) or die(mysql_error());
$row_users1= mysql_fetch_assoc($users1);?>

                       <td><?php echo $row_users1['firstname']; ?></td>
                      
                        <td><?php echo $row_users['distance']; ?></td>
                       <td><?php echo $row_users['rent']; ?></td>
                       
                        <?php echo '<td><a href="edit_trans.php?id=' . $row_users['ticket_code'] . '"><button  type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit">
  <span class="glyphicon glyphicon-edit"></span>
</button></a>&nbsp;';
                echo '<a onclick="return window.confirm(\'Are You sure ? Do you want to delete this row?\');" href="delete_trans.php?id=' . $row_users['ticket_code'] . '"><button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Delete">
  <span class="glyphicon glyphicon-trash"></span>
</button></a></td>'; ?>


                      </tr>
                      <?php } while ($row_users = mysql_fetch_assoc($users)); ?>
                      </div>
                  </table>
                  </div>
                </div>
            
		
		</div>
            </div>
              <div class="col-md-5 col-md-offset-4" align="center">
            <div class="row">
            <?php paging();?>
            <form>
            <div class="col-lg-5 col-md-offset-1">
    <div class="input-group">
    	 <div class="controls">
      <input type="number" name="jump" min="1" max="<?php echo $totalPages_users+1; ?>" class="form-control" placeholder="jump to page" required>
      </div>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
      
    </div><!-- /input-group -->
  </div>
  </form>
			</div>
 			</div>
 			<?php } else echo "<div class='col-lg-5 col-md-offset-1 row'>
 			No records found !</div>";?>
            <hr>

            <footer>
                <p class="text-muted">
                    &copy; 2014 SCMS Solution by Lalji ,Ujjaval and Mohit.
                </p>
            </footer>
        </div>
      
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
            </body>
</html>
<?php
mysql_free_result($users);
?>
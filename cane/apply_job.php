<?php 
include_once('Connections/lalo.php');
if(isset($_POST['email']))
{
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$emai=$_POST['email'];
$gender=$_POST['gender'];
$today = date("Y-m-d H:i:s.u");
$af=$_POST['apply_for'];
mysql_select_db($database_lalo, $lalo);
$quer=mysql_query("INSERT INTO job(id,first_name, last_name,email,gender,apply_for,notif,date)VALUES('','$fname', '$lname', '$emai', '$gender', '$af','1','$today')");
header("location:index.php?rsent=1");
}
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="lalji">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>SCMS</title>


    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
            <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li  class="active"><a href="apply_job.php">Job</a></li>
            <li><a class="btn btn-lg btn-success" href="login.php" role="button">Login</a></li>
        </ul>
        <h3 class="text-muted">Project name</h3>
      </div>

     
        <div class="row centered-form">
           
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Apply For JOB</h3>
                        </div>
<div class="panel-body">
	<form role="form" action="apply_job.php" method="post">
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
					<input type="text" name="last_name" id="" class="form-control input-sm" placeholder="Last Name" required >
				</div>
			</div>
		</div>
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" id="" class="form-control input-sm" placeholder="Email" required >
		</div>
		
		
		</div>
		
			<div class="col-md-3">
				<div class="form-group">
					<label for="gender">Gender</label>

					<select name="gender" class="form-control" required>
						<option>Male</option>
						<option>Female</option>

					</select>
				</div>
			</div>
		</div>
				<div class="row">

			<div class="col-md-3">
				<div class="form-group">
					<label for="gender">Apply For</label>

					<select name="apply_for" class="form-control" required>
						<option>op1</option>
						<option>op2</option>

					</select>
				</div>
			</div>
		</div>

		
		<div class="form-group">
    <label for="exampleInputFile">Upload Resume</label>
    <input type="file" id="exampleInputFile">
    
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

      

     
      <div class="footer">
        <p>&copy; 2014 SCMS Solution by Lalji ,Ujjaval and Mohit	</p>
      </div>

    </div> <!-- /container -->
 <script src="js/jqBootstrapValidation.js"></script>
		<script>
  		$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
		</script>
         <script src="js/jquery.min.js" type="text/javascript"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
       

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

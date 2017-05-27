<?php
require_once("functions.php");

require_once("dbconnect.php");

// Making the cookie live for 2 weeks

session_set_cookie_params(2*7*24*60*60);
session_start();
$_SESSION = array();
$nameError = $passError = $error = '';

if(isset($_POST['submit'])){
/* username and password sent from form 

*data is escaped to protect it from MySQL injection
**/ 

$myusername = mysql_real_escape_string($_POST['myusername']);
$mypassword = mysql_real_escape_string($_POST['mypassword']);
$tbl_name="admin_users"; // Table name 

// Empty field validation

  if (empty($myusername) )  {
   $error = true;
   $nameError = "Please enter username.";
  }
  
   if (empty($mypassword)){
   $error = true;
   $passError = "Please enter password.";
  }
 
	  
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_array($result);

// Mysql_num_row is counting table row

$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1 && $row['password']==$mypassword){

// Register $myusername, $mypassword and redirect to file "login_success.php"

$_SESSION['user'] = $row['userid'];

header("location:dashboard.php");
}
else {
	 $errMSG = "Wrong Username or Password...";
}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Article Manager Software</title>
<link rel="stylesheet" href="assets/admin/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="assets/css/style.css" type="text/css" />
</head>

<body>

<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Sign In - For the Bloggers</h2>
            </div>
        
         <div class="form-group">
             <hr/>
            </div>
 <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
   
   <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="text" name="myusername" class="form-control" placeholder="Your Username" value="<?php if (isset($myusername) )  echo $myusername; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
   
   <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="mypassword" class="form-control" placeholder="Your Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>

 <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="submit">Sign In</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>

			</div>
   
    </form>
    </div> 

</div>
</body>
<?php
 
?>
</html>

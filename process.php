<?php
require_once 'functions.php';
require_once 'dbconnect.php';
$nameError = $emailError = $error = '';

// check if comment form is submitted and get its data

if(isset($_POST['submit'])) {
		
//get data from comment form	
	
$name = mysql_real_escape_string($_POST['name']);
$email = mysql_real_escape_string($_POST['email']);
$comment = mysql_real_escape_string($_POST['comment']);
$date  = date('Y-m-d H:i:s');
	
// Empty field validation

  if (empty($name) || empty($email))  {
   $error = true;
   $nameError = "Please fill all the fields to submit the form.";
  }

   
   if(!$error){
  
  mysqli_query($connect, "INSERT INTO comments(name, email, comment, publicationDate)
				VALUES('$name','$email','$comment','$date')");
	
}
}
		
redirect("articletemplate.php");
		?>

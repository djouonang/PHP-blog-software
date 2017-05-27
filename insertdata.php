<?php

require_once 'functions.php';
require_once("dbconnect.php"); //connect to database

if( isset($_POST['submit'] )){
	
					
    $pic = rand(1000,100000)."-".$_FILES['file']['name'];
    $pic_loc = $_FILES['file']['tmp_name'];             //get uploaded files to temporary directory
     $folder="images/";
	 $targetpath = $folder.$pic;      // image file path to upload to database
     if(move_uploaded_file($pic_loc,$targetpath))
     {
        ?><script>alert('Article created successfully');</script><?php
		
	$title = $_POST['post_title'];
	$content = $_POST['post_content'];
	$tags = $_POST['tags'];
	$category = $_POST['category'];
	$date  = date('Y-m-d H:i:s');
	
	//upload article info to database
	
mysqli_query($connect, "INSERT INTO articles(post_title, post_content, tags, category, image_upload, publicationDate)
				VALUES('$title','$content','$tags','$category', '$targetpath', '$date')");

		
     }
     else
     {
        ?><script>alert('error with file upload. Make sure file size does not exceed 1 MB');</script><?php
     }
	 
	  
	
		
 redirect("dashboard.php");
 
}
?>

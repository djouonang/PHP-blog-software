<?php

//  redirect to login page for non logged in users

session_start();

if( !isset($_SESSION['user']) ) {
  header("Location: login.php");
  exit;
 }

require_once("dbconnect.php");

// set page title
$title = "Dashboard";

if(isset($_GET['edit_id']))
{
 $sql_query="SELECT * FROM articles WHERE id=".$_GET['edit_id'];
 $result_set=mysqli_query($connect, $sql_query);
 $fetched_row=mysqli_fetch_array($result_set);
}
if(isset($_POST['btn-update']))
{
 // variables for input data
 
 	$title = $_POST['post_title'];
	$content = $_POST['post_content'];
	$tags = $_POST['tags'];
	$category = $_POST['category'];
	$date  = date('Y-m-d H:i:s');
	
 // variables for input data

 // sql query for update data into database
 $sql_query = "UPDATE articles SET post_title='$title',post_content='$content',tags='$tags',category='$category',publicationDate='$date' WHERE id=".$_GET['edit_id'];
 // sql query for update data into database
 
 // sql query execution function
 
 if(mysqli_query($connect, $sql_query))
 {
 ?>
  
  <script type="text/javascript">
  alert('Data Updated Successfully');
  window.location.href='dashboard.php';
  </script>
  
  <?php
 }
 else
 {
  ?>
  <script type="text/javascript">
  alert('error occured while updating data');
  </script>
  <?php
 }
 // sql query execution function
}
if(isset($_POST['btn-cancel']))
{
 header("Location: dashboard.php");
}
// select loggedin users detail

 $res=mysqli_query($connect, "SELECT * FROM admin_users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res);
?>



<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Welcome - <?php echo $userRow['username']; ?></title>
	<link rel="stylesheet" href="assets/admin/css/bootstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="assets/admin/css/layout.css" type="text/css" media="screen" />
	
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="assets/admin/js/validate.js"></script>
	<script type="text/javascript" src="assets/admin/js/jquery-1.12.4-jquery.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
	
	</script>

</head>

<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.php">VIEW FRONTEND</a></h1>
			<a href="logout.php"><button class="btn btn-lg btn-danger" type="button"><i class="fa fa-sign-out"></i>Logout</button></a>
			
			<h2 class="section_title">Dashboard - For the Bloggers</h2>
			</hgroup>

	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Djouonang Landry (<a href="#">Web Developer</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		
		<hr/>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; For testing purposes</strong></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		
	<h4 class="alert alert_info">Welcome to Article Manager Software.</h4>
		
		
			<div class="clear"></div>

		
		<form  method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Edit Article</h3></header>
				<div class="module_content">
						<fieldset>
							<label>Post Title</label>
							<input type="text" name="post_title" value="<?php echo $fetched_row['post_title']; ?>" id="post_title" onblur="check_post_title();" />
							<br>
                            <span class='error_text' id='post_title_error'></span>
						</fieldset>
						<fieldset>
							<label>Content</label>
							<textarea name="post_content"  id="post_content" rows="12" onblur="check_post_content();"><?php echo $fetched_row['post_content']; ?></textarea>
							<br>
                            <span class='error_text' id='post_content_error'></span>
						</fieldset>
						<fieldset>
							<label>Upload Image</label>
							<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
							<input type="file" name='file' id='file' /><br/>
						</fieldset>
						<fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Category</label>
							<select name="category"  id="category" style="width:92%;">
							<option value="Web Design" <?=$fetched_row['category'] == 'Web Design' ? ' selected="selected"' : '';?>Web Design</option>
							<option value="SEO"  <?=$fetched_row['category'] == 'SEO' ? ' selected="selected"' : '';?>SEO</option>
							</select>
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Tags</label>
							<input type="text" name="tags" value="<?php echo $fetched_row['tags']; ?>" id="tags" style="width:92%;">
						</fieldset><div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					   <button type="submit" name="btn-update"  value="Publish" ><strong>UPDATE</strong></button>
                       
					
				</div>
				<div class="submit_link">
					   <button type="submit" name="btn-cancel"><strong>Cancel</strong></button>
				</div>
			</footer>
		</article><!-- end of post new article -->
		</form>
			
	<div class="spacer"></div>
	</section>

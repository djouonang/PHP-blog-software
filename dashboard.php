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

// if the rights are not set then add them in the current session

// delete condition for articles
if(isset($_GET['delete_id']))
{
	$sql_query="DELETE FROM articles WHERE id=".$_GET['delete_id'];
	mysqli_query($connect,$sql_query);
	header("Location: $_SERVER[PHP_SELF]");
}

// delete condition for comments
if(isset($_GET['delete_comment']))
{
	$sql_query="DELETE FROM comments WHERE id=".$_GET['delete_comment'];
	mysqli_query($connect,$sql_query);
	header("Location: $_SERVER[PHP_SELF]");
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
	<link rel="stylesheet" href="assets/admin/css/bootstrap.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="assets/admin/css/layout.css" type="text/css" media="screen" />
	
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="assets/admin/js/validate.js"></script>
	<script type="text/javascript" src="assets/admin/js/jquery-1.12.4-jquery.min.js"></script>
    <script type="text/javascript" src="assets/admin/js/bootstrap.min.js"></script>
	
	<script src="assets/admin/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="assets/admin/js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
     { 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

<script type="text/javascript">
function edt_id(id)
{
	if(confirm('Sure to edit ?'))
	{
		window.location.href='edit.php?edit_id='+id;
	}
}
function delete_id(id)
{
	if(confirm('Sure to Delete ?'))
	{
		window.location.href='dashboard.php?delete_id='+id;
	}
}


function delete_comment(id)
{
	if(confirm('Sure to Delete ?'))
	{
		window.location.href='dashboard.php?delete_comment='+id;
	}
}
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
		
		<h4 class="alert  alert_info">Welcome to Article Manager Software.</h4>
		
		
				<div class="clear"></div>
			</div>
		
		
		<article class="module width_full">
		<header><h3 class="tabs_involved">List of Articles</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th>Title</th> 
    				<th>Category</th> 
    				<th>Created On</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			
		<?php 

		//get values from the articles table of the database

        $query = "SELECT * FROM articles ";

        $result = mysqli_query($connect, $query);

		 while($row = mysqli_fetch_array($result)){
  
 
        $post_title          = $row['post_title'];
        $category            = $row['category'];
        $publicationDate     = $row['publicationDate'];
  
			?>
		
			<tbody> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td><?php echo  $post_title ; ?></td> 
    				<td><?php echo  $category  ; ?></td> 
    				<td><?php echo  $publicationDate ; ?></td> 
    				<td><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="images/icn_edit.png" align="EDIT" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="images/icn_trash.png" align="DELETE" /></a></td> 
				</tr> 
				 
				
		    <?php   }  ?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th>Comment</th> 
    				<th>Posted by</th> 
    				<th>Posted On</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<?php 

		//get values from the articles table of the database

        $quer = "SELECT * FROM comments ";

        $result = mysqli_query($connect, $quer);

		 while($row = mysqli_fetch_array($result)){
  
 
        $name          = $row['name'];
		$comment          = $row['comment'];
        $email         = $row['email'];
        $publicationDate   = $row['publicationDate'];
  
			?>
			<tbody> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td><?php echo  $comment ; ?></td> 
    				<td><?php echo  $name ; ?></td> 
    				<td><?php echo  $publicationDate ; ?></td> 
    				<td><a href="javascript:delete_comment('<?php echo $row[0]; ?>')"><img src="images/icn_trash.png" align="DELETE" /></a></td> 
				</tr> 
				
				<?php   }  ?>
			</tbody> 
			</table>

			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
		<div class="clear"></div>
		
		<form action="insertdata.php" method="post" id="article-form" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Post New Article</h3></header>
				<div class="module_content">
						<fieldset>
							<label>Post Title</label>
							<input type="text" name="post_title" value = "" id="post_title" onblur="check_post_title();" />
							<br>
                            <span class='error_text' id='post_title_error'></span>
						</fieldset>
						<fieldset>
							<label>Content</label>
							<textarea name="post_content" id="post_content" rows="12" onblur="check_post_content();"></textarea>
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
							<select name="category" id="category" style="width:92%;">
								<option>Web Design</option>
								<option>SEO</option>
							</select>
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Tags</label>
							<input type="text" name="tags" value = "" id="tags" style="width:92%;">
						</fieldset><div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
					
					<input type="submit" name="submit" value="Publish" onclick="return check_form();"  class="alt_btn">
				</div>
			</footer>
		</article><!-- end of post new article -->
		</form>
		
		
		
		
		
		<div class="spacer"></div>
	</section>


</body>

</html>

<?php
require_once("dbconnect.php");

$nameError = $emailError = $error = '';
//retrieve article

if(isset($_GET['article_id']))
{
 $sql_query="SELECT * FROM articles WHERE id=".$_GET['article_id'];;
 $result_set=mysqli_query($connect, $sql_query);
 $row = mysqli_fetch_array($result_set);
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $row['post_title']; ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<link rel="stylesheet" href="assets/admin/css/bootstrap.css" type="text/css" media="screen" />

<link rel="stylesheet" href="style.css"  type="text/css" media="all" />


</head>
	
<body>
<!-- banner-body -->
	
		
	<div class="single-page-artical">
		<div class="artical-content">
			<h3><?php echo $row['post_title']; ?></h3>
			<img class="img-responsive" src="images/banner.jpg" alt=" " />
			<p><?php echo $row['post_content']; ?></p>
		</div>
		<div class="artical-links">
			<ul>
				<li><small> </small><span><?php echo $row['publicationDate']; ?></span></li>
				
				<li><a href="index.php"><small class="posts"> </small><span>View posts</span></a></li>
				
			</ul>
		</div>
		
		<div class="comment-grid-top">
			<h3>Responses</h3>
			<?php
		
		        //retrieve comments

                $sql_query="SELECT * FROM comments";
                $result_set=mysqli_query($connect, $sql_query);
				while($row = mysqli_fetch_array($result_set)){
		
		?>
			<div class="comments-top-top">
				<div class="top-comment-left">
					<a href="#"><img class="img-responsive" src="images/co.png" alt=""></a>
				</div>
				<div class="top-comment-right">
					<ul>
						<li><span class="left-at"><a href="#"><?php echo $row['name']; ?></a></span></li>
						<li><span class="right-at"><?php echo $row['publicationDate']; ?></span></li>
						<li><a class="reply" href="#">REPLY</a></li>
					</ul>
				<p><?php echo $row['comment']; ?></p>
				</div>
				<div class="clearfix"> </div>
			</div>
			<?php   }  ?>
			
		</div>			
		<div class="artical-commentbox">
			<h3>leave a comment</h3>
			<span class="text-danger"><?php echo $nameError; ?></span>
			<div class="table-form">
				<form action="process.php" method="post">
					<input type="text" name="name" placeholder="name" class="textbox" value="" >
					<input type="text" name="email" placeholder="email" class="textbox" value="">
					<textarea name="comment"  placeholder="Comment"></textarea>	
					<input type="submit" name="submit" value="Send">
				</form>
			</div>
		</div>	
	</div>
<!-- single -->
		</div>	
</body>
</html>

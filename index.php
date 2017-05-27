<?php
require_once("dbconnect.php");

 $sql_query="SELECT * FROM articles";
 $result_set=mysqli_query($connect, $sql_query);
 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Test Blog</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/maintest.css" />
    <script type="text/javascript">
    function article_id(id)
    {
	if(confirm('You are About to Leave this page ?'))
	{
		window.location.href='articletemplate.php?article_id='+id;
	}
    }

    </script>
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><a href="index.php">Hirelandry.com</a></h1>
				
			</header>

	

		<!-- Banner -->
			<section id="banner">
				<i class="icon fa-diamond"></i>
				<h2>Test blog</h2>
				<p>Developed for testing purposes only</p>
				<ul class="actions">
					<li><a href="#" class="button big special">Am no Link</a></li>
				</ul>
			</section>
            
		<!-- One -->
		
			<section id="one" class="wrapper style1">
				<div class="inner">
				<h2 style="text-align: center;">Recent Articles</h2>
				<?php
		
		        while($row = mysqli_fetch_array($result_set)){
			 
			    ?>
					<article class="feature left">
						<span class="image"><img src="<?php echo $row['image_upload']; ?>" alt="" /></span>
						<div class="content">
							<h2><?php echo $row['post_title']; ?></h2>
							<p><?php echo $row['post_content']; ?></p>
							<ul class="actions">
								<li>
									<a href="javascript:article_id('<?php echo $row[0]; ?>')" class="button alt">Read More</a>
								</li>
							</ul>
						</div>
					</article>
					<?php   }  ?>
					
				</div>
			</section>

				


		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						
					</ul>
					<ul class="copyright">
						<li>&copy; For testing purposes.</li>
						<li><a href="http://hirelandry.com/">Hirelandry</a>.</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>

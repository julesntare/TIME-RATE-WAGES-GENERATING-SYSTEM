<?php
include ('empconnect.php');
include ('session_files/session_start.php');
 ?>
<?php
$result=mysqli_query($conn,"SELECT * from admin where adminname='$adminname'")or die(mysqli_error($conn));
$row=mysqli_fetch_array($result);
$adminname=$row['adminname'];
$password=$row['password'];
?>
<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="css/emptime.css">
<title>Home Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="icon" href="images/title_icon.png" type="image/x-png">
</head>
<body>
<header>
	<img src="images/banner.jpg">
	<nav>
		<div class="menu_logo">
			<div>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<ul id="menu">
			<li class="active"><a href="home.php" title="Home page">HOME</a></li>
			<li><a href="register.php" title="Registration room">INSERT EMPLOYEE</a></li>
			<li><a href="view.php" title="View Employees">VIEW</a></li>
			<li><a href="generate.php" title="active Employees">GENERATE</a></li>
			<li><a href="report.php" title="Report of the day">REPORT</a></li>
			<li><a href="search.php" title="retreiving room">SEARCH</a></li>
			<li><a href="logout.php" title="Get out of the system">LOGOUT</a></li>
		</ul>
	</nav>
	<?php
	$uc=strtoupper($adminname);
	echo "<span>welcome <button class='but'>".$uc."</button> to our system</span>";
	?>
</header>
<section>
	<div class="welcome">
		WELCOME TO TIME RATE WAGES GENERATING SYSTEM
	</div>
</section>
<?php include('footer.php'); ?>
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.menu_logo').click(function () {
			$('ul li').slideToggle()
		})
	})
</script>
</body>
</html>
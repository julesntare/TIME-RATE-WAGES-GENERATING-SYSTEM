<?php
include('empconnect.php');
include ('session_files/session_start.php');
 ?>
 <?php
$result=mysqli_query($conn,"SELECT * from admin where adminname='$adminname'")or die(mysqli_error($conn));
$row=mysqli_fetch_array($result);
$adminname=$row['adminname'];
$password=$row['password'];
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/emptime.css">
	<title>Registration Page</title>
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
		<ul>
			<li><a href="home.php" title="Home page">HOME</a></li>
			<li class="active"><a href="register.php" title="Registration room">INSERT EMPLOYEE</a></li>
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
		<h1>
			REGISTER TO PARTICIPATE IN SYSTEM
		</h1>
		<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST" enctype="multipart/form-data">
		<span id="regerror">
	<?php
		include ('errors/register_errors_report.php');
	?>
	</span>
		<div class="inputs">
			<div class="input">
			<label>
			FIRST NAME
			</label><br>
			<input type="text" name="firstname" size="28" value="<?php echo $display['firstname']; ?>" autofocus autocomplete='off' pattern="[(a-z)(A-ZA)]+$" required>
			<label>
			LAST NAME
			</label><br>
			<input type="text" name="lastname" size="28" value="<?php echo $display['lastname']; ?>" autocomplete='off' pattern="[(a-z)(A-ZA)]+$" required>
			<label>
			USERNAME
			</label><br>
			<input type="text" name="username" size="28" value="<?php echo $display['username']; ?>" autocomplete='off' required>
			<label>
			GENDER
			</label><br>
			<label>MALE</label><input type="radio" name="gender" value="male" checked>
			<label>FEMALE</label><input type="radio" name="gender" value="female">
		</div>
		<div class="input">
			<label>
				PHONE
			</label><br>
			<input type="text" name="phone" size="28" value="<?php echo $display['phone']; ?>" autocomplete='off' pattern="[0-9]+$" required>
			<label>
				JOB TITLE
			</label><br>
			<input type="text" name="jobtitle" size="28" value="<?php echo $display['jobtitle']; ?>" autocomplete='off' pattern="[(a-z)(A-ZA)]+$" required>
			<label>
				SALARY/HOUR
			</label><br>
			<input type="text" name="salary" value="<?php echo $display['salary']; ?>" autocomplete='off' pattern="[0-9]+$" required>
		</div>
		</div>
		<input type="submit" name="submit" value="SIGN IN"><input type="reset" value="RESET">
		</form>
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

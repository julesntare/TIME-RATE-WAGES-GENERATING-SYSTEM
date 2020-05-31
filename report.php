<?php
include('empconnect.php');
include('session_files/session_start.php');
 ?>
 <?php
$result=mysqli_query($conn,"SELECT * from admin where adminname='$adminname'")or die(mysqli_error());
$row=mysqli_fetch_array($result);
$adminname=$row['adminname'];
$password=$row['password'];
?>
<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="css/emptime.css">
	<title>Report Page</title>
	<link rel="icon" href="images/title_icon.png" type="image/x-png">
</head>
<body>
<header>
	<img src="images/banner.jpg">
	<nav>
		<ul>
			<li><a href="home.php" title="Home page">HOME</a></li>
			<li><a href="register.php" title="Registration room">INSERT EMPLOYEE</a></li>
			<li><a href="view.php" title="View Employees">VIEW</a></li>
			<li><a href="generate.php" title="active Employees">GENERATE</a></li>
			<li class="active"><a href="report.php" title="Report of the day">REPORT</a></li>
			<li><a href="search.php" title="retreiving room">SEARCH</a></li>
			<li><a href="logout.php" title="Get out of the system">LOGOUT</a></li>
		</ul>
	</nav>
<span><a href="mreport.php"><button style="height:40px; width:auto;">Search Monthly Report</button></a></span>
</header>
<section class="view_section">
<h1>All Days Reports</h1>
<span class="searching">
	<form method="POST" action="report.php">
		<input type="submit" name="search" value="fetch this date">
		<input type="date" name="date">
	</form>
</span>
<?php
if (isset($_POST['search']) && !empty($_POST['date'])) {
	?>
	<table id="response_table">
<?php
$date=date("Y-m-d");
$time=date("H:i:s A");
$selec=mysqli_query($conn,"SELECT* from report");
$fec=mysqli_fetch_array($selec);
$da=$fec['date'];
$search_by_date=$_POST['date'];
if (isset($_POST['search'])) {
$qy=mysqli_query($conn,"SELECT* from report where date='$search_by_date'");
$num=mysqli_num_rows($qy);
if ($num==0) {
	echo "<script>";
	echo "alert('no report done at this date')";
	echo "</script>";
	header("Refresh:0");
}
else{
	$i=1;
	while ($row=mysqli_fetch_array($qy)) {
		if ($i<=4) {
		echo "<tr>";
		echo "<td>On ".$search_by_date."<br></td>";
		echo "<td> we have paid all employees worked with total amount of money equivalent to <span style='background-color:green; color:white;'>".$row['moneyout']."RWF</span> which was paid all <span style='background-color:green; color:white;'>".$row['workers']."</span> employees</td>";
		echo "</tr>";
	}
	}
	}
}
?>
<br><br>
	</table>
<?php
}
else
{
?>
<table id="response_table">
<?php
$date=date("Y-m-d");
$moneyout=mysqli_query($conn,"SELECT sum(salaryearned) from temp where date='$date'");
$add=mysqli_fetch_array($moneyout);
$sum=$add['sum(salaryearned)'];
$number_of_workers=mysqli_query($conn,"SELECT username from temp where date='$date'");
$count=mysqli_num_rows($number_of_workers);
$s=mysqli_query($conn,"SELECT*from report");
$f=mysqli_fetch_array($s);
$dati=$f['date'];
$select=mysqli_query($conn,"SELECT*from report where date='$date'");
$fetch=mysqli_fetch_array($select);
$d=$fetch['date'];
$mon=$fetch['moneyout'];
$work=$fetch['workers'];
if ($d==$date) {
mysqli_query($conn,"UPDATE report set moneyout='$sum',workers='$count' where date='$date' order by date");
	$qy=mysqli_query($conn,"SELECT* from report");
	$i=1;
	while ($row=mysqli_fetch_array($qy)) {
		if ($i<5) {
		echo "<tr>";
		echo "<td>On ".$row['date']."<br></td>";
		echo "<td> we have paid all employees worked with total amount of money equivalent to <span style='background-color:green; color:white;'>".$row['moneyout']."RWF</span> which was paid all <span style='background-color:green; color:white;'>".$row['workers']."</span> employees</td>";
		echo "</tr>";
		$i++;
	}
}
}
else
{
	mysqli_query($conn,"INSERT into report values('','$sum','$count',NOW())");
	$query=mysqli_query($conn,"SELECT* from report");
	while ($row=mysqli_fetch_array($query)) {
		echo "<tr>";
		echo "<td>On ".$row['date']."<br></td>";
		echo "<td> we have paid all employees worked with total amount of money equivalent to <span style='background-color:green;'>".$row['moneyout']."RWF</span> which was paid all <span style='background-color:green;'>".$row['workers']."</span> employees</td>";
		echo "</tr>";
	}
}
?>
</table>
<?php
}
?>
</section>
<?php include('footer.php'); ?>
</body>
</html>
<?php
include('empconnect.php');
include ('session_files/session_start.php');
 ?>
 <?php
$adminname=$_SESSION['adminname'];
$result=mysqli_query($conn,"SELECT * from admin where adminname='$adminname'")or die(mysqli_error());
$row=mysqli_fetch_array($result);
$adminname=$row['adminname'];
$password=$row['password'];
?>
<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="css/emptime.css">
	<title>Search Page</title>
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
      <li><a href="report.php" title="Report of the day">REPORT</a></li>
      <li class="active"><a href="search.php" title="retreiving room">SEARCH</a></li>
      <li><a href="logout.php" title="Get out of the system">LOGOUT</a></li>
    </ul>
  </nav>
</header>
<section class="view_section">
  <h1>list of all Month Salaries Paid</h1>
<span class="searching">
<form method="POST" action="msalaries.php" enctype="multipart/form-data">
  <input type="submit" name="select" value="search month">
<input type="text" name="month" autofocus>
</span>
<table class="c">
<tr><thead>
<th>No</th>
<th>All Money paid</th>
<th>Month</th>
<th>All Workers</th>
</thead>
</tr>
<?php
if (isset($_POST['select'])) {
  $mon=$_POST['month'];
$sear=mysqli_query($conn,"SELECT*from msalaries where month='$mon'");
$c=mysqli_num_rows($sear);
if ($c && $sear) {
  $i=1;
    while ($row=mysqli_fetch_array($sear)) {
      if ($i<9) {
  echo '<tr>';
  echo "<td>".$i."</td>";
    echo "<td>".$row['salary']."</td>";
     echo"<td>".$row['workers']."</td>";
     echo"<td>".$row['month']."</td>";
     echo '</tr>';
     }
    $i++;
}
  ?>
<?php
}
else
{
  echo "<script>";
  echo "alert('no salaries paid in this month')";
  echo "</script>";
}
}
else
{
  $se=mysqli_query($conn,"SELECT sum(salaryearned) from salaries");
  $f=mysqli_fetch_array($se);
$sum=$f['sum(salaryearned)'];
$sel=mysqli_query($conn,"SELECT distinct username from salaries");
$cou=mysqli_num_rows($sel);
mysqli_query($conn,"UPDATE msalaries set salary='$sum',workers='$cou' where month='september'");
$sea=mysqli_query($conn,"SELECT*from msalaries");
if ($sea) {
  $i=1;
    while ($row=mysqli_fetch_array($sea)) {
      if ($i<9) {
  echo '<tr>';
  echo "<td>".$i."</td>";
    echo "<td>".$row['salary']."</td>";
     echo"<td>".$row['month']."</td>";
     echo"<td>".$row['workers']."</td>";
     echo '</tr>';
     }
    $i++;
}
}
}
?>
</table>
</section>
<?php include('footer.php'); ?>
</body>
</html>
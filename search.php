<?php
include('empconnect.php');
include('session_files/session_start.php');
if (isset($_POST['search'])) {
  $valuetosearch=$_POST['valuetosearch'];
  $query="SELECT * FROM `salaries` WHERE concat(`username`, `jobtitle`, `started`,`ended`,`salary`, `salaryearned`,`date`) LIKE '%".$valuetosearch."%'";
  $search_result=filterTable($query);
}
elseif (isset($_POST['select'])) {
  $valuetoselect=$_POST['valuetoselect'];
  $query="SELECT username,jobtitle,started,ended,salary,salaryearned,date FROM `salaries` WHERE date='$valuetoselect'";
  $search_result=filterTable($query);
}
else
{
$query="SELECT * FROM `salaries` order by date DESC";
$search_result=filterTable($query);
}
function filterTable($query)
{
  include('empconnect.php');
$filter_result=mysqli_query($conn,$query);
return $filter_result;
}
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
  <span>
    <a href="msalaries.php"><button style="height:40px; width:auto;">Search Months</button></a>
  </span>
</header>
<section class="view_section">
    <h1>list of all salaries</h1>
<span class="searching">
    <form method="POST" action="search.php">
    <input type="submit" name="search" value="search">
    <input type="text" name="valuetosearch" placeholder="search more employees..." autofocus>
    </form>
</span>
<span class="searching" style="float: left;">
    <form method="POST" action="search.php" enctype="multipart/form-data">
    <input type="submit" name="select" value="fetch">
    <input type="date" name="valuetoselect" autofocus>
    </form>
</span>
<table class="c">
<tr><thead style="color:white;">
<th>N<sup><u>o</u></sup></th>
<th>Username</th>
<th>Jobtitle</th>
<th>Started</th>
<th>Ended</th>
<th>Salary/hour</th>
<th>Salaryearned</th>
<th>Date</th></thead>
</tr>
<?php
$i=1;
$resul=mysqli_query($conn,'SELECT*from salaries order by date DESC') or die(mysqli_error());
$num=mysqli_num_rows($resul);
  $search_result=filterTable($query);
    while ($row=mysqli_fetch_array($search_result)):
      if ($i<9) {
  echo '<tr>';
echo "<td>".$i."</td>";
    echo "<td>".$row['username']."</td>";
     echo"<td>".$row['jobtitle']."</td>";
     echo"<td>".$row['started']."</td>";
     echo"<td>".$row['ended']."</td>";
    echo"<td><b>".$row['salary']."</b></td>";
     echo"<td>".$row['salaryearned']."</td>";
     echo"<td>".$row['date']."</td>";
     echo '</tr>';
     }
    $i++;
  endwhile;
  ?>
    </table>
</section>
<?php include('footer.php'); ?>
</body>
</html>
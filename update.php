<?php
 include('empconnect.php');
 $sql=mysql_query("SELECT *FROM empreg") or die(mysql_error());
$epr='';
if(isset($_GET['epr']))
$epr=$_GET['epr'];
if ($epr=='saveup')
 {
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$username=$_POST['username'];
$ucuser=ucwords($username);
$gender=$_POST['gender'];
$phone=$_POST['phone'];
$jobtitle=$_POST['jobtitle'];
$ucjob=ucwords($jobtitle);
$salary=$_POST['salary'];
$id=$_POST['id'];
$select=mysql_query("SELECT*from empreg where username='$username'");
$fetch=mysql_fetch_array($select);
$user=$fetch['username'];
$phon=$fetch['phone'];
if ($username==$user) {
echo "<font style='background-color:red; color:white;'>this username have been registered. enter different</font>";
}
elseif ($phon==$phone) {
echo "<font style='background-color:red; color:white;'>this phone number have been registered. enter different</font>";
}
elseif (strlen($_POST['phone'])!=10) {
	echo "<font style='background-color:red; color:white;'>you have to enter 10 numbers</font>";
}
else{
$update=mysql_query("UPDATE empreg SET firstname='$fname', lastname='$lname',username='$ucuser',gender='$gender',phone='$phone',jobtitle='$ucjob',salary='$salary' WHERE id='$id'") or die(mysql_error());
if ($update) {
	mysql_query("UPDATE temp set username='$ucuser',jobtitle='$ucjob',salary='$salary' where id='$id'");
	echo "<script>";
	echo "alert('employee\'s info have been edited well')";
	echo "</script>";
	echo "<META http-equiv=refresh content=0;url=view.php>";
	mysql_close();
}
	else{
		echo'failed to update'.mysql_error();
	}
}
}
?>
<?php
include('empconnect.php');

session_start();
if(isset($_SESSION['adminname']))
 {
  $mail=$_SESSION['adminname'];
 } else {
 	echo "<META http-equiv=refresh content=0;url=index.php>";
 }
 ?>
 <?php

$adminname=$_SESSION['adminname'];

$result=mysql_query("SELECT * from admin where adminname='$adminname'")or die(mysql_error());
$row=mysql_fetch_array($result);
$adminname=$row['adminname'];
$password=$row['password'];
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/emptime.css">
	<title>Update Page</title>
	<link rel="icon" href="images/title_icon.png" type="image/x-png">
</head>
<body><center>
<img src="images/banner.jpg" class="ban">
<div>
	<ul id="Menu">
	<li><a href="home.php" title="Home page">HOME</a></li>
<li><a href="register.php" title="Registration room">INSERT EMPLOYEE</a></li>
<li><a href="view.php" title="View Employees">VIEW</a></li>
<li><a href="generate.php" title="active Employees">GENERATE</a></li>
<li><a href="report.php" title="Report of the day">REPORT</a></li>
<li><a href="search.php" title="retreiving room">SEARCH</a></li>
<li><a href="logout.php" title="Get out of the system">LOGOUT</a></li>
</ul>
<div class="div" style="z-index:2;">
	<center>
		<font style="font-size:30px; font-family:'algerian',sans-serif; position:absolute; top:-5px; left:140px;">
			CHANGE INFORMATION FOR THIS EMPLOYEE<br>
		</font>
<?php
if ($epr=='update') {
	$id=$_GET['id'];
$row=mysql_query("SELECT id,firstname,lastname,username,gender,phone,jobtitle,salary FROM empreg where id='$id'") or die(mysql_error());
$st_row=mysql_fetch_array($row);
}
	?>
	<form  method="POST" action='update.php?epr=saveup' enctype="multipart/form-data">
	<table>
	<tr>
	<td style="position:relative; top:40px; left:-60px; color:rgb(204,229,254);">
		<input type="text" name="id" value="<?php echo $st_row['id']; ?>" style="border:0; background:rgba(0,0,0,0);" hidden required autocomplete="off"><br><br>
			<label>
			<font>FIRST NAME</font>
		</label><br>
		<input type="text" name="firstname" value="<?php echo $st_row['firstname']; ?>" style="border:0; background:rgba(0,0,0,0);" pattern="[(a-z)(A-ZA)]+$" required autocomplete="off"><br><br>
		<label>
			LAST NAME
		</label><br>
		<input type="text" name="lastname" value="<?php echo $st_row['lastname']; ?>" style="border:0; background:rgba(0,0,0,0);" pattern="[(a-z)(A-ZA)]+$" required autocomplete="off"><br><br>
		<label>
			USERNAME
		</label><br>
		<input type="text" name="username" value="<?php echo $st_row['username']; ?>" style="border:0; background:rgba(0,0,0,0);" required autocomplete="off"><br><br>
		<label>
		GENDER
		</label><br>
		<input type="text" name="gender" style="border:0; background:rgba(0,0,0,0);" value="<?php echo $st_row['gender']; ?>">
	</td>
	<td style="position:relative; top:38px; left:0px; color:rgb(204,229,254);">
		<label>
			PHONE
		</label><br>
		<input type="text" name="phone" value="<?php echo $st_row['phone']; ?>" style="border:0; background:rgba(0,0,0,0);" pattern="[0-9]+$" required autocomplete="off"><br><br>
		<label>
			JOB TITLE
		</label><br>
		<input type="text" name="jobtitle" value="<?php echo $st_row['jobtitle']; ?>" style="border:0; background:rgba(0,0,0,0);" pattern="[(a-z)(A-ZA)]+$" required autocomplete="off"><br><br>
		<label>
			SALARY/HOUR
		</label><br>
		<input type="text" name="salary" value="<?php echo $st_row['salary']; ?>" style="border:0; background:rgba(0,0,0,0);" pattern="[0-9]+$" required autocomplete="off"><br>
	</td>
	</tr>
	</table>
		<input type="submit" name="save" value="APPLY EDIT">&nbsp &nbsp &nbsp &nbsp<input type="reset" value="RESET"></form>
	</div><center class="botto"><FONT SIZE="3" COLOR="white" style="font-family: 'castellar' sans-serif;">&copy copyright for <font style="font-family: 'Agency FB' sans-serif; font-size:18px;">Time Rate Wages Generating System</font>
 designed by  <b>JULES NTARE</b>  2017</FONT>
</center></center>
</body>
</html>
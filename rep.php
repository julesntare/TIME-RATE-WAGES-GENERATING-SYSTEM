<html>
<head> 
	<title></title>
</head>
<body>
<?php
include("empconnect.php");
$date=date("Y-m-d");
$time=date('H:i:s A');
$moneyout=mysql_query("SELECT SUM(salaryearned) from salaries where date=CURDATE()");
$add=mysql_fetch_array($moneyout);
$sum=$add['SUM(salaryearned)'];
$num=mysql_query("SELECT username from salaries where date=CURDATE()");
$number=mysql_num_rows($num);
$insert=mysql_query("INSERT into report values('','$sum','$number','$date')");
$select=mysql_query("SELECT*from report");
$fetch=mysql_fetch_array($select);
$da=$fetch['date'];
$money=$fetch['moneyout'];
$workers=$fetch['workers'];
$update=mysql_query("UPDATE report set moneyout='$money',workers='$workers',date='$da' where date='$da'");
$count=mysql_num_rows($select);
if ($count==0) {
	$insert;
}
else{
	$update;
}
?>
</body>
</html>
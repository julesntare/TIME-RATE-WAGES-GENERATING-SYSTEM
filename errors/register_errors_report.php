<?php
	$display = array(
		'firstname' => '',
		'lastname' => '',
		'username' => '',
		'phone' => '',
		'jobtitle' => '',
		'salary' => ''
	);
	
foreach($_POST as $key => $value){
	if(isset($display[$key])){
		$display[$key] = htmlspecialchars($value);
	}
}
if (isset($_POST['submit'])) {
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$username=$_POST['username'];
$ucuser=ucwords($username);
$gender=$_POST['gender'];
$phone=$_POST['phone'];
$jobtitle=$_POST['jobtitle'];
$ucjob=ucwords($jobtitle);
$salary=$_POST['salary'];

$select=mysqli_query($conn,"SELECT*from empreg where username='$username'");
$fetch=mysqli_fetch_array($select);
$user=$fetch['username'];
$phon=$fetch['phone'];
if ($username==$user) {
echo "<font style='background-color:red; color:white;'>this username have been registered. enter different</font>";
}
else if ($phon==$phone) {
echo "<font style='background-color:red; color:white;'>this phone number have been registered. enter different</font>";
}
else if (strlen($_POST['phone'])!=10) {
	echo "<font style='background-color:red; color:white;'>you have to enter 10 numbers</font>";
}
else
{
$query=mysqli_query($conn,"INSERT into empreg values('','$fname','$lname','$ucuser','$gender','$phone','$ucjob','$salary',NOW(),CURDATE())") or die(mysqli_error($conn));
if ($query) {
	$_session['username']=$username;
	$word=$_session['username'];
	$uc=ucwords($word);
	echo "<font color=white>hello  "."<u>"."<button>".$uc."</button>"."</u>"."   have been successfully registered to our system."."please wait...</font>";
	echo "<META http-equiv=refresh content=2;url=view.php>";
}
else
{
	echo "error".mysqli_error($conn);
}
}
}
?>
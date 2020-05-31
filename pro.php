<?php
include('empconnect.php');
if (!isset($_FILES['image']['tmp_name'])) {
	echo "";
	}else{
	$file=$_FILES['image']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
			move_uploaded_file($_FILES["image"]["tmp_name"],"profiles/" . $_FILES["image"]["name"]);
			$location="profiles/" .$_FILES["image"]["name"];

			$fname=$_POST['id'];
			$lname=$_POST['firstname'];
			$name=$_POST['lastname'];
			$name=$_POST['username'];
			$jobtitle=$_POST['jobtitle'];
			$pass=$_POST['password'];
			$save=mysql_query("INSERT INTO empreg (id, firstname, lastname, username, jobtitle,password) VALUES ('$location','$id','$fname','$lname','$name','$jobtitle','$pass')");
			header("location: new.php");
			exit();
	}
?>
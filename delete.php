<?php
include('empconnect.php');
if(isset($_GET['delete']))
	$username=$_GET['delete'];
	$delete=mysqli_query($conn, "DELETE from empreg where username='$username'") or die(mysqli_error($conn));
	if($delete)
	{
		echo 'deleted successfully';
	echo "<META http-equiv=refresh content=0;url=view.php>";
	}
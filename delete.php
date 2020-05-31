<?php
mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('emptimemgtsys') or die(mysql_error());
if(isset($_GET['delete']))
	$username=$_GET['delete'];
	$delete=mysql_query("DELETE from empreg where username='$username'") or die(mysql_error());
	if($delete)
	{
		echo 'deleted successfully';
	echo "<META http-equiv=refresh content=0;url=view.php>";
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
<?php
	
	session_start();
	$_session['username']=$username;
	$word=$_session['username'];
	$uc=strtoupper($word);
	echo "<META http-equiv=refresh content=7;url=view.php>";
?>
 </body>
 </html>
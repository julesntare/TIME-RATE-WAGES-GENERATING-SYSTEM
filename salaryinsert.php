<?php
mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('emptimemgtsys') or die(mysql_error());
mysql_query('INSERT into salaries(id,username,started,ended) values()') or die(mysql_error());
?>
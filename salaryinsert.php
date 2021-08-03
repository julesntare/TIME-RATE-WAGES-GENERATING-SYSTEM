<?php
include('empconnect.php');
mysqli_query($conn ,'INSERT into salaries(id,username,started,ended) values()') or die(mysqli_error($conn));
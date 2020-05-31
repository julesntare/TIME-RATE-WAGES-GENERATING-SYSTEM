<?php
    if(isset($_SESSION['adminname']))
    {
     $adminname=$_SESSION['adminname'];
    } else {
        echo "<META http-equiv=refresh content=0;url=index.php>";
    }
?>
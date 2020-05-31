<?php
include ('empconnect.php');
?>
<!DOCTYPE html>
<html>
<head><title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="icon" href="images/title_icon.png" type="image/x-png">
  <link rel="stylesheet" href="css/login.css"></head>
<body>
<div class="container">
    <form action="index.php" method="post">
    <h1>TIME RATE WAGES SYSTEM LOGIN</h1>
    <span class="req">
        <?php
        if (isset($_POST['SubmitButton'])) {
        $adminname=$_POST['adminname'];
        $passwor=$_POST['password'];
        $check=mysqli_query($conn,"SELECT * FROM admin where adminname='$adminname'")or die(mysqli_error($conn));
        $info=mysqli_fetch_array($check);
        $admin=$info['adminname'];
        $password=$info['password'];
        $check2=mysqli_num_rows($check);

        if ($admin!=$adminname){
        echo'please fill in real username';
        }
        else if($password!=$passwor)
        {
        echo'please fill in your real Password';
        }
        else
        {
        $_SESSION['adminname'] = $adminname;
        $_SESSION['password'] = $password;
        echo "<div class='lds-ring'>
        <div></div>
        <div></div>
      </div>";
        echo "<META http-equiv=refresh content=2;url=home.php>";
        }
        }
        ?>
    </span>
    <input type="text" name="adminname" class="login-input" placeholder="Username"  autofocus autocomplete="off" required>
    <input type="password" name="password" class="login-input"  placeholder="Password" required>
    <input type="submit" name="SubmitButton" value="Login" class="login-submit"><br>
  </form>
</div>
</body>
</html>

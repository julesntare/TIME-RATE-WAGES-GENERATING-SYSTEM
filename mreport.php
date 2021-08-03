<?php
include('empconnect.php');
include('session_files/session_start.php');
?>
<?php

$adminname = $_SESSION['adminname'];

$result = mysqli_query($conn, "SELECT * from admin where adminname='$adminname'") or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
$adminname = $row['adminname'];
$password = $row['password'];
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/emptime.css">
    <title>Report Page</title>
    <link rel="icon" href="images/title_icon.png" type="image/x-png">
</head>

<body>
    <header>
        <img src="images/banner.jpg">
        <nav>
            <ul>
                <li><a href="home.php" title="Home page">HOME</a></li>
                <li><a href="register.php" title="Registration room">INSERT EMPLOYEE</a></li>
                <li><a href="view.php" title="View Employees">VIEW</a></li>
                <li><a href="generate.php" title="active Employees">GENERATE</a></li>
                <li class="active"><a href="report.php" title="Report of the day">REPORT</a></li>
                <li><a href="search.php" title="retreiving room">SEARCH</a></li>
                <li><a href="logout.php" title="Get out of the system">LOGOUT</a></li>
            </ul>
        </nav>
    </header>
    <section class="view_section">
        <h1>All Months Reports</h1>
        <span class="searching">
            <form method="POST" action="mreport.php">
                <input type="submit" name="search" value="fetch this Month">
                <input type="text" name="month">
            </form>
        </span>
        <?php
		include("empconnect.php");
		if (isset($_POST['search']) && !empty($_POST['month'])) {
		?>
        <table id="response_table">
            <?php
				$date = date("Y-m-d");
				$time = date("H:i:s A");
				$mo = $_POST['month'];
				$qy = mysqli_query($conn, "SELECT* from mreport where month='$mo'");
				$num = mysqli_num_rows($qy);
				if ($num == 0) {
					echo "<script>";
					echo "alert('no report done in this month')";
					echo "</script>";
				} else {
					while ($row = mysqli_fetch_array($qy)) {
						echo "<tr>";
						echo "<td>In " . $mo . "<br></td>";
						echo "<td> we have paid all employees worked with total amount of money equivalent to <button style='background-color:green; color:white;'>" . $row['moneyout'] . "RWF</button> which was paid all <button style='background-color:green; color:white;'>" . $row['workers'] . "</button> employees</td>";
						echo "</tr>";
					}
				}
				?>
        </table>
        <?php
		} else {
		?>
        <table id="response_table">
            <?php
				$date = date("Y-m");
				$moneyout = mysqli_query($conn, "SELECT sum(moneyout) from report");
				$add = mysqli_fetch_array($moneyout);
				$sum = $add['sum(moneyout)'];
				$number_of_workers = mysqli_query($conn, "SELECT sum(workers) from report");
				$ad = mysqli_fetch_array($number_of_workers);
				$su = $ad['sum(workers)'];
				$s = mysqli_query($conn, "SELECT*from report");
				$f = mysqli_fetch_array($s);
				$dati = $f['date'];
				$select = mysqli_query($conn, "SELECT*from mreport where month='september'");
				$fetch = mysqli_fetch_array($select);
				$m = $fetch['month'];
				$mon = $fetch['moneyout'];
				$work = $fetch['workers'];
				if ('2017-09' == $date) {
					mysqli_query($conn, "UPDATE mreport set moneyout='$sum',workers='$su',month='september'");
					$qy = mysqli_query($conn, "SELECT* from mreport");
					while ($row = mysqli_fetch_array($qy)) {
						echo "<tr>";
						echo "<td>In " . $m . "<br></td>";
						echo "<td> we have paid all employees worked with total amount of money equivalent to <button style='background-color:green; color:white;'>" . $row['moneyout'] . "RWF</button> which was paid all <button style='background-color:green; color:white;'>" . $row['workers'] . "</button> employees</td>";
						echo "</tr>";
					}
				} else {
					mysqli_query($conn, "INSERT into mreport values('','$sum','$su','october')");
					$query = mysqli_query($conn, "SELECT* from mreport");
					while ($row = mysqli_fetch_array($query)) {
						echo "<tr>";
						echo "<td>In " . 'october' . "<br></td>";
						echo "<td> we have paid all employees worked with total amount of money equivalent to <button style='background-color:green;'>" . $row['moneyout'] . "RWF</button> which was paid all <button style='background-color:green;'>" . $row['workers'] . "</button> employees</td>";
						echo "</tr>";
					}
				}
				?>
        </table>
        <?php
		}
		?>
    </section>
    <?php include('footer.php'); ?>
</body>

</html>
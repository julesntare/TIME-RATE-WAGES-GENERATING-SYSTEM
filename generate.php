<?php
include('empconnect.php');
include('session_files/session_start.php');
mysqli_query($conn, "DELETE from temp where date!=CURDATE()");
?>
<?php
if (isset($_POST['save'])) {
	$insert = mysqli_query($conn, "INSERT into salaries(id,username,jobtitle,started,ended,salary,salaryearned,date) SELECT id,username,jobtitle,started,ended,salary,salaryearned,date from temp");
	if ($insert) {
		echo "<script>";
		echo "alert('today\'s work was saved successfully')";
		echo "</script>";
	} else {
		echo "<script>";
		echo "alert('today\'s work wasn\'t saved')";
		echo "</script>";
		echo "" . mysqli_error($conn);
	}
}
?>

<?php
if (isset($_POST['search'])) {
	$valuetosearch = $_POST['valuetosearch'];
	$quer = "SELECT * FROM `temp` WHERE concat(`username`, `jobtitle`, `started`, `ended`,`salary`, `salaryearned`, `date`) LIKE '%" . $valuetosearch . "%'";
	$search_result = filterTable($quer);
} else {
	$quer = "SELECT * FROM `temp` order by time";
	$search_result = filterTable($quer);
}
function filterTable($quer)
{
	include('empconnect.php');
	$filter_result = mysqli_query($conn, $quer) or die(mysqli_error($conn));
	return $filter_result;
}
?>

<?php
$result = mysqli_query($conn, "SELECT * from admin where adminname='$adminname'") or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
$adminname = $row['adminname'];
$password = $row['password'];
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/emptime.css">
    <title>wages generating page</title>
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
                <li class="active"><a href="generate.php" title="active Employees">GENERATE</a></li>
                <li><a href="report.php" title="Report of the day">REPORT</a></li>
                <li><a href="search.php" title="retreiving room">SEARCH</a></li>
                <li><a href="logout.php" title="Get out of the system">LOGOUT</a></li>
            </ul>
        </nav>
        <?php
		$uc = strtoupper($adminname);
		echo "<span>welcome <button class='but'>" . $uc . "</button> to our system</span>";
		?>
    </header>
    <section class="view_section">
        <form method="POST" action="generate.php" enctype="multipart/form-data" class="search">
            <input type="submit" name="search" value="search">
            <input type="text" name="valuetosearch" placeholder="search more employees..." autofocus>
        </form>
        <table class="c">
            <tr>

                <th>No</th>
                <th>Username</th>
                <th>Jobtitle</th>
                <th>Start time</th>
                <th>End time</th>
                <th>Salary/hour</th>
                <th>Wage earned</th>
            </tr>
            <?php
			if (isset($_POST['generate'])) {
				error_reporting(0);
				$username = mysqli_real_escape_string($conn, $_POST['username']);
				$started = $_POST['started'];
				$ended = $_POST['ended'];
				$salary = mysqli_real_escape_string($conn, $_POST['salary']);
				$salaryearned = ($ended - $started) * $salary;
				if ($started > $ended || $started == $ended) {
			?>
            <script type="text/javascript">
            alert('Starting hour can\'t be greater than or equal ending hour');
            </script>
            <?php
				} else {
					mysqli_query($conn, "UPDATE temp set started='$started',ended='$ended',salaryearned='$salaryearned' where username='$username'");
				}
			}
			?>

            <?php
			$update = "UPDATE temp,empreg set temp.username='empreg.username',temp.jobtitle='empreg.jobtitle',temp.salary='empreg.salary',temp.date=NOW() where temp.username='empreg.username'";
			?>
            <?php
			$i = 1;
			$search_result = filterTable($quer);
			while ($row = mysqli_fetch_array($search_result)) {
				if ($i < 8) {
					echo "<tr>";
					echo "<form method='post' action='generate.php'>";
					echo "<td><input type='text' name='no' value='$i' style='width:14px; border:0'></td>";
					echo "<td><input type='text' name='username' value='$row[username]' style='width:90px; font-weight:bold; border:0' readonly></td>";
					echo "<td><input type='text' name='jobtitle' value='$row[jobtitle]' style='width:95px; border:0' readonly></td>";
					echo "<td>" . "<input type='time' name='started' value='$row[started]' style='width:76px; border:0' autofocus>" . "</td>";
					echo "<td>" . "<input type='time' name='ended' value='$row[ended]' style='width:76px; border:0px;'><input type='submit' name='generate' id='generate' value='generate'>" . "</td>";
					echo "<td><input type='text' name='salary' value='$row[salary] RWF' style='width:70px; border:0' readonly></td>";
					echo "<td><button style='width:100px;'><input type='text' name='salaryearned' value='$row[salaryearned] RWF' style='width:80px; border:0; font-weight:bold;'></button></td>";
					echo "</form>";
					echo "</tr>";
				} else {
					echo "<tr><td>hi</td></tr>";
				}
				$i++;
			}
			?>
        </table>
        <form method="POST" action="generate.php">
            <input type="submit" name="save" value="save for today" style="margin: 3px 0;">
        </form>
    </section>
    <?php include('footer.php'); ?>
</body>

</html>
<?php
include('empconnect.php');
include('session_files/session_start.php');
$sql = "SELECT * FROM empreg";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
?>
<script language="javascript">
function validate() {
    var chks = document.getElementsByName('checkbox[]');
    var hasChecked = false;
    for (var i = 0; i < chks.length; i++) {
        if (chks[i].checked) {
            hasChecked = true;
            break;
        }
    }

    if (hasChecked == false) {
        alert("Please choose at least one employee.");
        return false;
    }
    return true;
}
</script>
<?php
$result = mysqli_query($conn, "SELECT * from admin where adminname='$adminname'") or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
$adminname = $row['adminname'];
$password = $row['password'];
?>
<?php
$sql = mysqli_query($conn, "SELECT *FROM empreg order by firstname ASC") or die(mysqli_error($conn));
$epr = '';
if (isset($_GET['epr']))
	$epr = $_GET['epr'];
if ($epr == 'delete') {
	$id = $_GET['id'];
	$delete = mysqli_query($conn, "DELETE from empreg where id='$id'");
	if ($delete) {
		mysqli_query($conn, "DELETE from temp where id=$id");
		echo "<script>";
		echo "alert('this employee is removed from system')";
		echo "</script>";
		echo "<META http-equiv=refresh content=0;url=view.php>";
	} else {
		$msg = "error" . mysqli_error($conn);
	}
}
?>
<?php
if (isset($_POST['search'])) {
	$valuetosearch = $_POST['valuetosearch'];
	$query = "SELECT * FROM `empreg` WHERE concat(`firstname`, `lastname`, `username`, `gender`,`phone`, `jobtitle`, `salary`) LIKE '%" . $valuetosearch . "%'";
	$search_result = filterTable($query);
} else {
	$query = "SELECT * FROM `empreg` order by time DESC";
	$search_result = filterTable($conn, $query);
}
function filterTable($conn, $query)
{
	$filter_result = mysqli_query($conn, $query);
	return $filter_result;
}
?>
<?php
$sql = "SELECT * FROM empreg order by time DESC";

$records = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/emptime.css">
    <title>All Employees Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="images/title_icon.png" type="image/x-png">
</head>

<body>
    <header>
        <img src="images/banner.jpg">
        <nav>
            <div class="menu_logo">
                <div>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <ul>
                <li><a href="home.php" title="Home page">HOME</a></li>
                <li><a href="register.php" title="Registration room">INSERT EMPLOYEE</a></li>
                <li class="active"><a href="view.php" title="View Employees">VIEW</a></li>
                <li><a href="generate.php" title="active Employees">GENERATE</a></li>
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
        <h1>
            <u class='u'>list of all employees</u>
        </h1>
        <span class="searching">
            <form method="POST" action="view.php">
                <input type="text" name="valuetosearch" placeholder="search more employees..." autofocus>
                <input type="submit" name="search" value="search">
            </form>
        </span>
        <form method="POST" action="view.php" onsubmit="return validate()">
            <table cellpadding="2" cellspacing="2" class="c">
                <tr>
                    <thead>
                        <th></th>
                        <th>N<sup><u>o</u></sup></th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Jobtitle</th>
                        <th>SALARY/HOUR</th>
                        <th>Actions</th>
                    </thead>
                </tr>
                <?php
				$i = 1;
				$resul = mysqli_query($conn, 'SELECT*from empreg order by time DESC') or die(mysqli_error($conn));
				$num = mysqli_num_rows($resul);
				if ($num == 0) {
					echo "<span style='color:white;'>";
					echo "no person registered in the system";
					echo "</span>";
				} elseif ($num == 1) {
					echo "<span style='color:white;'>";
					echo "There is   <button>" . $num . "</button>   Employee registered in the system";
					echo "</span>";
				} else {
					echo "<span style='color:white;'>";
					echo "There are   <button>" . $num . "</button>   Employees registered in the system";
					echo "</span>";
				}
				$search_result = filterTable($conn, $query);
				while ($row = mysqli_fetch_array($search_result)) :
					$id = $row['id'];
					if ($i < 8) {
						echo '<tr>';
						echo "<td><input type='checkbox' name='checkbox[]' id='checkbox[]' value=" . $row['username'] . "></td>";
						echo "<td>" . $i . "</td>";
						echo "<td>" . $row['firstname'] . "</td>";
						echo "<td>" . $row['lastname'] . "</td>";
						echo "<td><b>" . $row['username'] . "</b></td>";
						echo "<td>" . $row['gender'] . "</td>";
						echo "<td>" . $row['phone'] . "</td>";
						echo "<td>" . $row['jobtitle'] . "</td>";
						echo "<td>" . $row['salary'] . "RWF</td>";
						echo "<td class='actions'><a href='update.php?epr=update&id=" . $row['id'] . "'>edit</a>
	 <a href='view.php?epr=delete&id=" . $row['id'] . "'>delete</a></td>";
						echo '</tr>';
					}
					$i++;
				endwhile;
				?>
            </table>
            <?php
			if (isset($_POST['check'])) {
				for ($i = 0; $i < count($_POST['checkbox']); $i++) {
					$check_name = $_POST['checkbox'][$i];
					$select = mysqli_query($conn, "SELECT*from empreg where username='$check_name'");
					$fetch = mysqli_fetch_array($select);
					$id = $fetch['id'];
					$user = $fetch['username'];
					$job = $fetch['jobtitle'];
					$sal = $fetch['salary'];
					$date = date('Y-m-d');
					$sql = "INSERT into temp values('$id','$user','$job','','','$sal','',NOW(),NOW())";
					$result = mysqli_query($conn, $sql);
				}
				if ($result) {
					echo "<script>";
					echo "alert('successfully added to his wage Generating')";
					echo "</script>";
					echo "<meta http-equiv=refresh content=0;url=generate.php>";
				} else {
					echo "<script>";
					echo "alert('no person selected')";
					echo "</script>";
				}
			}
			mysqli_close($conn);
			?>
            <input type="submit" name="check" id="check" value="ADD TO BE PAID">
        </form>
        <form method="POST" action="excel.php" class="export">
            <input type="submit" name="export_excel" value="export to excel">
        </form>
    </section>
    <?php include('footer.php'); ?>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.menu_logo').click(function() {
            $('ul li').slideToggle()
        })
    })
    </script>
</body>

</html>
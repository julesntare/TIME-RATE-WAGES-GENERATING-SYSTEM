<?php
include('empconnect.php');
$output='';
if (isset($_POST['export_excel'])) {
	$sql="SELECT firstname,lastname,username,gender,phone,jobtitle,salary from empreg";
    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)>0) {
    	$output.='
        <table border="1" cellpadding="2"  cellspacing="2">
<tr><thead>
<th>Firstname</th>
<th>Lastname</th>
<th>Username</th>
<th>Gender</th>
<th>Phone</th>
<th>Jobtitle</th>
<th>SALARY/HOUR</th></thead>
</tr>';
    while ($row=mysqli_fetch_array($result)){
    	$output.='
  <tr>
  <td>'.$row["firstname"].'</td>
  <td>'.$row['lastname'].'</td>
  <td>'.$row['username'].'</td>
  <td>'.$row['gender'].'</td>
  <td>'.$row['phone'].'</td>
  <td>'.$row['jobtitle'].'</td>
  <td>'.$row['salary'].'RWF</td>
   </tr>
   ';
    }
  $output.='</table>';
  header("Content-Type:application/xls");
  header("Content-Disposition:attachment; filename=download.xls");
  echo $output;
}
}
<?php
$con = mysqli_connect('','root') or die("unable to connect to database");
mysqli_select_db($con, "elternfreund");
$sql = "SELECT * FROM users";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
echo "$num Datensätze gefunden";
while ($row = mysqli_fetch_assoc($res))
	{echo $row["first_name"];}

?>
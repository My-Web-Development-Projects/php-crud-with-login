<?php  

$server = "localhost";
$user = "root";
$password = "";
$db_name = "data_crud";

$conn  = mysqli_connect($server, $user, $password, $db_name);

if (!$conn) {
	echo "<h1>Connection failed!</h1>";
}

?>
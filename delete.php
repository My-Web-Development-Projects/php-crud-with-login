<?php
require('auth.php');
require('db_conn.php');

$id = $_REQUEST['id'];
$select = "SELECT * FROM post WHERE id = '$id'";
$query = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($query);

if($row['data_image'] != '')
{
    unlink("image/".$row['data_image']);
}

$del = "DELETE FROM post WHERE id='$id'";
$result = mysqli_query($conn,$del);

if($result == true)
{
    header("Location: view.php?success=Delete Successful!!");
}
else
{
    header("Location: view.php?error=Delete Not Successful!!");
}
?>
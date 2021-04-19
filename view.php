<?php
require('auth.php');
require('db_conn.php');

$user_name = $_SESSION['user_name'];
$select = "SELECT * FROM user WHERE user_name = '$user_name'";
$query = mysqli_query($conn,$select);
$total = mysqli_fetch_assoc($query);
$id = $total['id'];

$select1 = "SELECT * FROM post WHERE user_id = '$id'";
$query1 = mysqli_query($conn,$select1);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="box">
			<h4 class="display-4 text-center">Read<br></h4>

			<?php if (isset($_GET['success'])) { ?>
			<div class="alert alert-success" role="alert">
				<?php echo $_GET['success']; ?>
			</div>
			<?php } if (isset($_GET['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $_GET['error']; ?>
			</div>
			<?php } ?>

			<div class="col-lg-12">
				<a class="btn btn-primary m-1 float-left" href="index.php">Add New Record</a>
				<a class="btn btn-secondary m-1 float-right" href="logout.php">Logout</a>
			</div>
			
			<table class="table table-bordered" style="margin-top: 3%;">
				<thead>
					<tr>
						<th>#</th>
						<th>Image</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Delete</th>
						<th>Edit</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					while($row = mysqli_fetch_assoc($query1))
					{
						?>
						<tr>
							<td><?php echo $count; ?></td>
							<td><img src = "image/<?php echo $row["data_image"]; ?>" height='100' width='100'/>
							</td>
							<td><?php echo $row['data_name']; ?></td>
							<td><?php echo $row['data_phone']; ?></td>
							<td><a class="btn btn-danger" 
								href="delete.php?id=<?php echo $row['id'];?>">Delete</a>
							</td>
							<td><a class="btn btn-success" 
								href="edit.php?id=<?php echo $row['id'];?>">Edit</a>
							</td>
							<td><a class="btn btn-primary" 
							href="download.php?file=<?php echo $row['data_image'];?>">Download</a>
							</td>
						</tr>
				</tbody>
					<?php
						$count++;
						}
					?>
					</table>
				</div>
			</div>
		</body>
		</html>
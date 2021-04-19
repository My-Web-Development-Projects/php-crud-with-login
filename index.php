<?php
require 'auth.php';
require 'db_conn.php';

$user_name = $_SESSION['user_name'];
$select = "SELECT * FROM user WHERE user_name = '$user_name'";
$query = mysqli_query($conn, $select);
$total = mysqli_fetch_assoc($query);
$id = $total['id'];

if(isset($_POST['submit']))
{
    $data_name = $_POST['data_name'];
    $data_phone = $_POST['data_phone'];
    $data_image = $_FILES['data_image']['name'];
    $extension = pathinfo($data_image, PATHINFO_EXTENSION);

    if($extension=='jpg' OR $extension=='jpeg')
    {
        if(move_uploaded_file($_FILES['data_image']['tmp_name'],'image/'.$data_image))
        {
            $insert = "INSERT INTO post(data_name,data_phone,data_image,user_id) 
            VALUES('$data_name','$data_phone','$data_image','$id')";
            $result = mysqli_query($conn, $insert);

            if($result == true)
            {
                header("Location:view.php?success=Record Successful !!!");
            }
            else
            {
                header("Location:view.php?error=Record Not Successful !!!");
            }
        }
    }
    else
    {
        header("Location:index.php?error=Image Not Supported! Only .jpg/.jpeg are supported. !!!");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="" method="post" enctype="multipart/form-data">
            
           <h4 class="display-4 text-center">Create</h4>
		   
		   <?php if (isset($_GET['success'])) { ?>
			<div class="alert alert-success" role="alert">
				<?php echo $_GET['success']; ?>
			</div>
			<?php } if (isset($_GET['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $_GET['error']; ?>
			</div>
			<?php } ?>
           
           <div class="link-right">
            <a href="logout.php" class="link-primary" style="font-weight: bold;">Logout</a>
        </div>
        <hr><br>
        <div class="form-group">
         <label for="name">Name</label>
         <input type="text" class="form-control" name="data_name" placeholder="Enter Name" required />
     </div>

     <div class="form-group">
         <label for="phone">Phone</label>
         <input type="text" class="form-control" name="data_phone" placeholder="Enter Phone No" required />
     </div>

     <div class="form-group">
         <label for="image">Image Upload</label>
         <input type="file" class="form-control" id="data_image" name="data_image" placeholder="Upload Image" required />
     </div>

     <input type="submit" class="btn btn-primary" name="submit" value="Create" />
     
     <div class="link-right">
        <a style="color: #0062cc; font-size: 18px;" href="view.php" class="link-primary">
        Click Here for View</a>
    </div>
</form>
</div>
</body>
</html>
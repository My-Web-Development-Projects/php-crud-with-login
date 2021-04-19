<?php
require 'auth.php';
require 'db_conn.php';

$id = $_REQUEST['id'];
$select = "SELECT * FROM post WHERE id = '$id'";
$query = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($query);

if(isset($_POST['id']))
{
    $id = $_REQUEST['id'];
    $data_name = $_REQUEST['data_name'];
    $data_phone = $_REQUEST['data_phone'];
    $data_image = $_FILES['data_image']['name'];
    $extension = pathinfo($data_image, PATHINFO_EXTENSION);

    if($data_image == '')
    {
      $update = "UPDATE post SET data_name='$data_name',data_phone='$data_phone' 
      WHERE id='$id'";
    }
    else
    {
      if($extension=='jpg' OR $extension=='jpeg')
      {
        if(move_uploaded_file($_FILES['data_image']['tmp_name'],'image/'.$data_image))
        {
          $update = "UPDATE post SET data_name='$data_name',data_phone='$data_phone',
          data_image='$data_image' WHERE id='$id'";
        }
      }
      else
      {
        header("Location:view.php?error=Image Not Supported! Only .jpg/.jpeg are supported.");
      }
    }
    $upd = mysqli_query($conn,$update);
      
    if($upd == true)
    {
      header("Location:view.php?success=Update Successful !!!");
    }
    else
    {
      header("Location:view.php?error=Update Not Successful !!!");
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
            
         <h4 class="display-4 text-center">Update</h4>
         <div class="link-right">
            <a href="logout.php" class="link-primary" style="font-weight: bold;">Logout</a>
        </div>
        <hr><br>

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />

        <div class="form-group">
           <label for="name">Name</label>
           <input type="text" class="form-control" name="data_name" 
           value="<?php echo $row['data_name']; ?>" 
           required />
       </div>

       <div class="form-group">
           <label for="name">Phone</label>
           <input type="text" class="form-control" name="data_phone" 
           value="<?php echo $row['data_phone']; ?>" 
           required />
       </div>

       <div class="form-group">
        <label for="image">Current Image</label>
        <?php if($row['data_image']==""){ ?>
            <img src="image/noimage.png" width="100" height="100"><?php } else {?>
                <img src="image/<?php echo $row['data_image'];?>" width="100" height="100">
            <?php } ?>
        </div>

        <div class="form-group">
           <label for="image">Image Upload</label>
           <input type="file" class="form-control" id="data_image" name="data_image" placeholder="Upload Image" />
       </div>

       <input type="submit" class="btn btn-primary" name="submit" value="Update" />
       <div class="link-right">
        <a href="view.php" class="link-primary" style="color: #0062cc; font-size: 18px;">
        Click Here for View</a>
    </div>
</form>
</div>
</body>
</html>
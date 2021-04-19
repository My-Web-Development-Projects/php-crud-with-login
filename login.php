<?php
require('db_conn.php');
session_start();

if(isset($_POST['submit']))
{
    $user_name = $_POST['user_name'];
    $user_pass = $_POST['user_pass'];
    
    $select = "SELECT * FROM user WHERE user_name = '$user_name' AND user_pass = '$user_pass'";
    $query = mysqli_query($conn,$select);
    $total = mysqli_fetch_assoc($query);

    if($total == true)
    {
        $_SESSION['user_name'] = $user_name;
        header("Location: index.php");
    }
    else
    {
        header("Location: login.php?error=Login Not Successful!!");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/form.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1">
                <img src="image/3.jpg" >
            </div>

            <div class="col-md-6 login-form-2">
                <h4 class="display-4 text-center" style="color: #ffffff;">Login</h4>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['success']; ?>
                    </div>
                <?php } if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="user_name" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="user_pass" required />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" name="submit" value="Login" />
                    </div>
                    <div class="link-right">
                        <a style="color: #ffffff; font-size: 18px;" href="register.php" class="link-primary">
                        Click Here for Registration</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
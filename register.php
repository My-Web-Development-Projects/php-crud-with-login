<?php
require('db_conn.php');

if(isset($_POST['submit']))
{
    $select = "SELECT * FROM user WHERE user_name = '".$_POST['user_name']."'";
    $query = mysqli_query($conn,$select);
    $total = mysqli_fetch_assoc($query);

    if($total != '')
    {
        header("Location: register.php?error=Username Already Exist!!");
    }
    else
    {
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];
        
        $insert = "INSERT INTO user(user_name,user_email,user_pass) 
        VALUES('$user_name','$user_email','$user_pass')";
        $result = mysqli_query($conn,$insert);

        if($result == true)
        {
            header("Location: register.php?success=Registration Successful!!");
        }
        else
        {
            header("Location: register.php?error=Registration Not Successful!!");
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/form.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h4 class="display-4 text-center">Registration</h4>
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
                        <input type="text" class="form-control" placeholder="Email" name="user_email" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="user_pass" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" name="submit" value="Register" />
                    </div>
                    <div class="link-right">
                        <a style="color: #0062cc; font-size: 18px;" href="login.php" class="link-primary">
                        Click Here for Login</a>
                    </div>
                </form>
            </div>
            <div class="col-md-6 login-form-2">
                <img src="image/3.jpg">
            </div>
        </div>
    </div>
</body>
</html>
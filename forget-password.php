<?php require_once('header.php'); ?>

<?php

if(isset($_POST['form1'])) {
    $valid = 1;

    if(empty($_POST['new_password']) || empty($_POST['re_password'])) {
        $valid = 0;
        echo "<script>
            alert('Please fill all fields.');
        </script>";
    } else if($_POST['new_password'] != $_POST['re_password']) {
        $valid = 0;
        echo "<script>
            alert('Password doesn\\'t match.');
        </script>";
    }

    if($valid == 1) {
        $email = strip_tags($_POST['email']);
        $new_password = md5($_POST['new_password']);
        $statement = $pdo->prepare("UPDATE tbl_customer SET cust_password=? WHERE cust_email=?");
        $statement->execute(array($new_password, $email));
    
        echo "<script>
            alert('Password has been reset successfully.');
            location.replace('login.php');
        </script>";
        exit;
    } else {
        $error_message = "There was an error resetting your password.";
    }
}
?>

<div class="page-banner" style="background-color:#444;">
    <div class="inner">
        <h1>Reset Password</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label>New Password *</label>
                                    <input type="password" class="form-control" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label>Re-enter New Password *</label>
                                    <input type="password" class="form-control" name="re_password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Reset Password" name="form1">
                                </div>
                                <a href="login.php" style="color:#e4144d;">Back to Login</a>
                            </div>
                        </div>  
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

<?php if ( ! defined('BASE')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<?php include_once "head.php"; ?>
<body>
<div class="log-w3">
<div class="w3layouts-main">
<?php
$error = false;
    $db = new Mysql();
    if(isset($_POST['submit'])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($db->checkLogIn($username, $password)){
            $_SESSION["loggedin"] = true;
            redirect(CTRL . "Ctrl_dashboard.php");
        }else{
            $error = true;
        }
    }
?>
<h2>Admin Log In</h2>
		<form method="post">
            <?php if(isset($_GET['notloggedin'])){ ?>
            <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> You need to log in to see that page.
            </div>
            <?php } ?>
            <?php if($error){ ?>
            <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> Wrong password.
            </div>
            <?php } ?>
            <input type="username" class="ggg" name="username" placeholder="Username" required/>
            <input type="password" class="ggg" name="password" placeholder="Password" required/>
            <input type="submit" value="Log In" name="submit"/>
		</form>
</div>
</div>
<?php include_once "scripts.php"; ?>
</body>
</html>
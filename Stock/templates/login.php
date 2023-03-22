<?php 
$fileStyle =__DIR__ . '/stylelogin.css';
$login = '<link href="stylelogin.css" rel="stylesheet" type="text/css">
<div class="registration-cssave">
    <form action="index.php" method="POST">
        <h3 class="text-center">Enter login and password</h3>
        <div class="form-group">
            <input class="form-control item" type="text" name="login" maxlength="15" minlength="4" pattern="^[a-zA-Z0-9_.-]*$" placeholder="Login">
        </div>
        <div class="form-group">
            <input class="form-control item" type="password" name="password" minlength="6" placeholder="Password">
        </div>
        <div class="form-group">
            <button name="loginAction" class="btn btn-primary btn-block create-account" type="submit">Login</button>
        </div>
        <div class="form-group">
            <button name="registerFormAction" class="btn btn-primary btn-block create-account" type="submit">Register</button>
        </div>
    </form>
</div>';
$login .= '<style type="text/css">' . file_get_contents($fileStyle) . '</style>';
echo $login;
?>
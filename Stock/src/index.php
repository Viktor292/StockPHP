<?php
use Database\Dao;
use View\View;
use Controllers\LoginController;
use Controllers\StockController;

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
});

$dao = new Dao();
$view = new View('C:\xampp\htdocs\Stock\templates');
$controllerLogin = new LoginController($dao, $view);
$controllerStock = new StockController($dao, $view);
session_start();

if (isset($_POST['addAction']))
{
    $controllerStock->addItem($_SESSION['user_id'], $_POST['name'], $_POST['typenumber'], $_POST['number'], $_POST['price'], $_POST['allprice'], $_POST['resultprice']);
} 
else if(isset($_POST['removeAction'])) 
{
    $controllerStock->removeItem($_SESSION['user_id'], $_POST['id']);
}
else if(isset($_POST['editAction'])) 
{
    $controllerStock->updateItem($_SESSION['user_id'], $_POST['id'], $_POST['name'], $_POST['typenumber'], $_POST['number'], $_POST['price'], $_POST['allprice'], $_POST['resultprice']);
}
else if(isset($_POST['removeAllAction'])) 
{
    $controllerStock->removeAllItems($_SESSION['user_id']);
}
else if(isset($_POST['loginAction'])) 
{
    $userId = $controllerLogin->login($_POST['login'], $_POST['password']);
    $_SESSION['user_id'] = $userId;
    ($userId != -1) ? $controllerStock->main($userId) : $controllerLogin->main(); 
}
else if(isset($_POST['registerFormAction'])) 
{
    $controllerLogin->registerForm();
}
else if(isset($_POST['registerAction'])) 
{
    $controllerLogin->register($_POST['login'], $_POST['password'], $_POST['passwordSecond']);
}
else if(isset($_POST['exitAction'])) 
{
    $controllerLogin->exit();
    if (session_status() === PHP_SESSION_ACTIVE) session_destroy();
}
else 
{
    if (session_status() === PHP_SESSION_ACTIVE) $controllerStock->main($_SESSION['user_id']);
    else $controllerLogin->main();
}

?>
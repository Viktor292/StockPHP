<?php
use Database\Dao;
use View\View;
use Controllers\LoginController;
use Controllers\StockController;

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
});

$dao = new Dao();
$dao->createDatabase();
$dao->createUserTable();
$view = new View('C:\xampp\htdocs\Stock\templates');
$controllerLogin = new LoginController($dao, $view);
$controllerStock = new StockController($dao, $view);

if (isset($_POST['addAction']))
{
    session_start();
    $controllerStock->addItem($_SESSION['user_id'], $_POST['name'], $_POST['typenumber'], $_POST['number'], $_POST['price'], $_POST['allprice'], $_POST['resultprice']);
} 
else if(isset($_POST['removeAction'])) 
{
    session_start();
    $controllerStock->removeItem($_SESSION['user_id'], $_POST['id']);
}
else if(isset($_POST['editAction'])) 
{
    session_start();
    $controllerStock->updateItem($_SESSION['user_id'], $_POST['id'], $_POST['name'], $_POST['typenumber'], $_POST['number'], $_POST['price'], $_POST['allprice'], $_POST['resultprice']);
}
else if(isset($_POST['removeAllAction'])) 
{
    session_start();
    $controllerStock->removeAllItems($_SESSION['user_id']);
}
else if(isset($_POST['loginAction'])) 
{
    $userId = $controllerLogin->login($_POST['login'], $_POST['password']);
    if ($userId != -1) 
    {
        $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }else
    if($status == PHP_SESSION_ACTIVE){
        session_destroy();
        session_start();
    }
    $_SESSION['user_id'] = $userId;
    $controllerStock->main($userId);
    } else 
    {
        $controllerLogin->main(); 
    }
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

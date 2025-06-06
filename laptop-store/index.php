<?php
session_start();
$mod = isset($_GET['act']) ? $_GET['act'] : "home";
switch ($mod) {
    case 'home':
        require_once('Controllers/HomeController.php');
        $controller = new HomeController();
        $controller->list();
        break;

    case 'detail':
        require_once('Controllers/HomeController.php');
        $controller = new HomeController();
        $controller->detail();
        break;
        case 'shop':
        require_once 'controllers/ProductController.php';
        $controller = new ProductController();
        $controller->shop();
        break;
            
    case 'login':
        require_once('Controllers/UserController.php');
        $c = new UserController();
        $c->login();
        break;

    case 'logout':
        require_once('Controllers/UserController.php');
        $c = new UserController();
        $c->logout();
        break;

    case 'register':
        require_once('Controllers/UserController.php');
        $c = new UserController();
        $c->register();
        break;
        case 'contact':
            require_once('views/contact.php');
            
            break;
            case 'about':
                require_once('views/about.php');
                
                break;
    default:
        header("Location: index.php");
        exit;
}
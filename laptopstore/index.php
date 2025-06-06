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
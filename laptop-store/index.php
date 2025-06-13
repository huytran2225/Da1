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

    case 'cart':
        require_once('controllers/CartController.php');
        $controller = new CartController();
        $action = isset($_GET['xuli']) ? $_GET['xuli'] : 'list';
        if ($action === 'add') {
            $controller->add();
        } else {
            $controller->list();
        }
        break;
    case 'checkout':
        require_once('Controllers/CheckoutController.php');
        $ctrl = new CheckoutController();
        $ctrl->process();
        break;
    case 'order_success':
        require_once('Controllers/CheckoutController.php');
        $ctrl = new CheckoutController();
        $ctrl->success();
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

    case 'orders':
        require_once 'controllers/OrderController.php';
        $controller = new OrderController();
        $controller->history();
        break;

    case 'register':
        require_once('Controllers/UserController.php');
        $c = new UserController();
        $c->register();
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

                case 'update_cart':
                    require_once('Controllers/CartController.php');
                    $cartController = new CartController();
                    $cartController->update_cart();
                    break;
                    case 'remove_cart_item':
                        require_once('Controllers/CartController.php');
                        $cartController = new CartController();
                        $cartController->remove();
                        break;
                         
    default:
        header("Location: index.php");
        exit;
}
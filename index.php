<?php
//Dès la connexion à ce site, toujours par ce point "index.php"
// on démarre une SESSION

session_start();

// pour toujours repartir de la base du site on ecrira au début de nos liens (image ou autre...) :
// URL dans des balises php
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https"  : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER["PHP_SELF"]));


require_once("./controllers/Images.controller.php");
require_once("./controllers/Main.controller.php");
require_once("./controllers/Visitor/Visitor.controller.php");
require_once("./controllers/User/User.controller.php");
require_once("./controllers/Editor/Editor.controller.php");
require_once("./controllers/Admin/Administrator.controller.php");
$visitorController = new VisitorController();
$userController = new UserController();
$editorController = new EditorController();
$administratorController = new AdminstratorController();
// $mainController = new MainController();
// $imagesController = new ImageController();




// l'index est le point d'entrée du site
// au lieu d'avoir, ex pour page d'accueil
// site/index.php?page=accueil
// on utilise htaccess pour obtenir :
// site/accueil 
// ce qui est plus convivial et lisible

try {
    if (empty($_GET['page'])) {
        $url[0] = "home";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($url[0]) {
            // test et test2 ne sont pas appelées par le site, juste pour voir ce que contiennt les classes
        case "test2":
            require_once('./test2.php');
            break;
        case "test":
            require_once('./test.php');
            break;


        case "home":
            $visitorController->homePage();
            break;
        case "theme":
            $themeChoisi = $secure->secureHTML($url[1]);
            echo "tu as choisi le thème : " . $url[1];
            break;
        case "connection":
            $visitorController->connectionPage();
            break;
        case "registration":
            $visitorController->registrationPage();
            break;
        case "validation_registration":
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail'])) {
                $login = Tools::secureHTML($_POST['login']);
                $password = Tools::secureHTML($_POST['password']);
                $mail = Tools::secureHTML($_POST['mail']);
                $userController->validationRegistration($login, $password, $mail);
            } else {
                Tools::alertMessage("Il faut remplir les 3 champs !", "orange");
                header('Location: ' . URL . 'registration');
            }
            break;
        case "mail_validation_account":
            $login = Tools::secureHTML($url[1]);
            $account_key = Tools::secureHTML($url[2]);
            $userController->validationAccountByLinkMail($login, $account_key);
            break;
        case "resend_validation_mail":
            $login = Tools::secureHTML($url[1]);
            $userController->resendValidationMail($login);
            break;
        case "forgot_password":
            $userController->forgotPasswordPage();
            break;
        case "send_forgot_password":
            if (!empty($_POST['login']) && !empty($_POST['mail'])) {
                $login = Tools::secureHTML($_POST['login']);
                $mail = Tools::secureHTML($_POST['mail']);
                $userController->sendForgotPassword($login, $mail);
            } else {
                Tools::alertMessage('Login ou mail non renseigné.', 'red');
                header('location:' . URL . "forgot_password");
                exit;
            }
            break;
        case "validation_login":
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = Tools::secureHTML($_POST['login']);
                $password = Tools::secureHTML($_POST['password']);
                $userController->validation_login($login, $password);
            } else {
                Tools::alertMessage("Il faut remplir les 2 champs !", "orange");
                header('Location: ' . URL . 'connection');
            }
            break;
            // ################################# User
        case "account":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "red");
                header('Location: ' . URL . 'connection');
            } elseif (!Tools::checkCookieConnection()) {
                Tools::badCookie();
            } else {
                require_once("./indexComponents/user.index.php");
            }
            break;
            // ################################# Editor
        case "editor":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "red");
                header('Location: ' . URL . 'connection');
            } elseif (!Tools::isEditor()) {
                Tools::alertMessage("Vous n'avez pas le statut requis.", "red");
                header('Location: ' . URL . 'home');
            } 
            elseif (!Tools::checkCookieConnection()) {
                Tools::badCookie();
            } 
            else {
                require_once("./indexComponents/editor.index.php");
            }
            break;
            // ################################# Administrator
        case "administrator":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "red");
                header('Location: ' . URL . 'connection');
            } elseif (!Tools::isAdministrator()) {
                Tools::alertMessage("Vous n'avez pas le statut requis.", "red");
                header('Location: ' . URL . 'home');
            } elseif (!Tools::checkCookieConnection()) {
                Tools::badCookie();
            } else {
                require_once("./indexComponents/administrator.index.php");
            }
            break;
        default:
            throw new Exception("La page demandée n'existe pas...");
    }
} catch (Exception $msg) {
    $visitorController->errorPage($msg->getMessage());
}

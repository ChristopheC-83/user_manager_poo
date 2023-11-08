<?php
//Dès la connexion à ce site, toujours par ce point "index.php"
// on démarre une SESSION
session_start();

// pour toujours repartir de la base du site on ecrira au début de nos liens (image ou autre...) :
// URL dans des balises php
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https"  : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER["PHP_SELF"]));


require_once("./controllers/Functions.controller.php");
$functions = new Functions();
require_once("./controllers/Secure.controller.php");
$secure = new Secure();
require_once("./controllers/Visitor/Visitor.controller.php");
$visitorController = new VisitorController();


// l'index est le point d'entrée du site
// au lieu d'avoir, ex pour page d'accueil
// site/index.php?page=accueil
//  on utilise htaccess pour obtenir :
//  site/accueil 
// ce qui est plus convivial et lisible

try {
    if (empty($_GET['page'])) {
        $url[0] = "home";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($url[0]) {
        case "home":
            $visitorController->homePage();
            break;
        case "theme":
            $themeChoisi = $secure->secureHTML($url[1]);
            // $themes = getAllThemes();
            echo "tu as choisi le thème : " . $url[1];
            // afficherTableau($themes);
            // verification($themeChoisi);
            // pageTheme($themeChoisi);
            break;
        case "connection":
            $visitorController->connectionPage();
            break;
        case "registration":
            $visitorController->registrationPage();
            break;
        case "forgot_password":
            $visitorController->forgotPassword();
            break;
        case "validation_login":
            Tools::showArray($_POST);
            break;
        default:
            throw new Exception("La page demandée n'existe pas...");
    }
} catch (Exception $msg) {
    $visitorController->errorPage($msg->getMessage());
}

<?php
//Dès la connexion à ce site, toujours par ce point "index.php"
// on démarre une SESSION
session_start();

// pour toujours repartir de la base du site on ecrira au début de nos liens (image ou autre...) :
// URL dans des balises php
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https"  : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER["PHP_SELF"]));


require_once("./controllers/Visitor/Visitor.controller.php");
require_once("./controllers/User/User.controller.php");
require_once("./controllers/Editor/Editor.controller.php");
require_once("./controllers/Admin/Administrator.controller.php");
$visitorController = new VisitorController();
$userController = new UserController();
$editorController = new EditorController();
$administratorController = new AdminstratorController();


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
            $visitorController->forgotPassword();
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

        case "account":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "red");
                header('Location: ' . URL . 'connection');
            } else {
                switch ($url[1]) {
                    case "profile":
                        $userController->profilePage();
                        break;
                    case "logout":
                        $userController->logout();
                        break;
                    case "modify_mail":
                        $newMail = Tools::secureHTML($_POST['new_mail']);
                        $userController->modifyMail($newMail);
                        break;
                    case "modify_password":
                        $userController->modifyPasswordPage();
                        break;
                    case "send_new_password":
                        if (!empty($_POST['password']) && !empty($_POST['new_password']) && !empty($_POST['verif_password'])) {
                            $old_password = Tools::secureHTML($_POST["password"]);
                            $new_password = Tools::secureHTML($_POST["new_password"]);
                            $verif_password = Tools::secureHTML($_POST["verif_password"]);
                            $userController->sendNewPassword($old_password, $new_password, $verif_password);
                        } else {
                            Tools::alertMessage("Il faut remplir les 3 champs !", "orange");
                            header('Location: ' . URL . 'account/modify_password');
                        }
                        break;
                    case "modify_avatar_by_site":
                        $newAvatar = Tools::secureHTML($url[2]);
                        $imageController->modifyAvatarBySite($newAvatar);
                        break;

                    case "modify_image_by_perso":
                        if ($_FILES['image']['size'] > 0) {
                            $imageController->modifyAvatarByPerso($_FILES['image']);
                        } else {
                            Tools::alertMessage("Image non modifiée", "rouge");
                            header('location:' . URL . "profil");
                        }
                        break;

























                    case "delete_account":
                        $userController->deleteAccount();
                        break;
                    default:
                        throw new Exception("La page demandée n'existe pas...");
                }
            }
            break;

            // ################################# Editor

        case "editor":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "red");
                header('Location: ' . URL . 'connection');
            } else if (!Tools::isEditor()) {
                Tools::alertMessage("Vous n'avez pas le statut requis.", "red");
                header('Location: ' . URL . 'home');
            } else {
                switch ($url[1]) {
                    case "write_article":
                        $editorController->writeArticle();
                        break;

                    default:
                        throw new Exception("La page demandée n'existe pas...");
                }
            }
            break;


            // ################################# Administrator

        case "administrator":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "red");
                header('Location: ' . URL . 'connection');
            } else if (!Tools::isAdministrator()) {
                Tools::alertMessage("Vous n'avez pas le statut requis.", "red");
                header('Location: ' . URL . 'home');
            } else {
                switch ($url[1]) {
                    case "user_accounts":
                        $administratorController->userAccounts();
                        break;

                    default:
                        throw new Exception("La page demandée n'existe pas...");
                }
            }
            break;

        default:
            throw new Exception("La page demandée n'existe pas...");
    }
} catch (Exception $msg) {
    $visitorController->errorPage($msg->getMessage());
}

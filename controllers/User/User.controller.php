<?php

require_once("./controllers/Main.controller.php");
require_once("./models/User/User.model.php");




class UserController extends MainController
{
    private $userManager;
    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->userManager = new UserManager();
    }
    public function validation_login($login, $password)
    {
        $datasUser = $this->userManager->getUserInfo($login);
        $_SESSION['profile']['role'] =  $datasUser['role'];

        if ($this->userManager->isCombinationValid($login, $password)) {
            if ($this->userManager->isAccountValidated($login)) {
                Tools::alertMessage("You're welcome !", "green");
                $_SESSION['profile']['login'] = $login;
                header('Location: ' . URL . 'home');
                // header('Location: ' . URL . 'account/profile');
            } else {
                Tools::alertMessage("Compteen attente validation", "orange");
                $msg = "<a href='resendValidationMail/" . $login . "'>=> Renvoyer le mail de validation <=</a> ";
                Tools::alertMessage($msg, "orange");
                header('Location: ' . URL . 'connection');
            }
        } else {
            Tools::alertMessage("Combinaison Mot de Passe / Pseudo invalide.", "red");
            header('Location: ' . URL . 'connection');
        }
    }
    public function profilePage()
    {
        $datasUser = $this->userManager->getUserInfo($_SESSION['profile']['login']);

        $data_page = [
            "page_description" => "Page de profil",
            "page_title" => "Page de profil",
            "datasUser" => $datasUser,
            "view" => "./views/User/profilePage.view.php",
            "template" => "./views/templates/template.php",

        ];
        $this->functions->generatePage($data_page);
    }
    public function logout()
    {
        unset($_SESSION['profile']);
        if ($_SESSION['profile']) {
            Tools::alertMessage("La déconnexion a échoué.", "red");
            header('Location: ' . URL . 'home');
        } else {
            Tools::alertMessage("Vous êtes bien déconnecté(e).", "green");
            header('Location: ' . URL . 'home');
        }
    }
    private function sendMailValidation($login, $mail, $account_key)
    {
        $urlValidation = URL . "mailValidationAccount/" . $login . "/" . $account_key;
        $sujet = "Validez Compte Barpat";
        $message = "Validez votre compte sur le blog de Barpat ! Nous t'attendons ! Cliquez sur :" . $urlValidation;
        Tools::sendMail($mail, $sujet, $message);
    }

    public function resendValidationMail($login){
        
        $datasUser = $this->userManager->getUserInfo($login);
        $this->sendMailValidation($login, $datasUser['mail'], $datasUser['account_key']);
        Tools::alertMessage("Mail de validation renvoyé !", "green");
        header('Location: ' . URL . 'connection');
    }
    private function registerAccount($login, $password, $mail, $account_key)
    {
        if ($this->userManager->registerAccountDB($login, $password, $mail, $account_key)) {
            $this->sendMailValidation($login, $mail, $account_key);
            Tools::alertMessage("Compte créé ! Lien de validation envoyé par mail.", "green");
            header('Location: ' . URL . 'home');
        } else {
            Tools::alertMessage("La création a échoué, Réessayez !", "rouge");
            header('Location: ' . URL . 'registration');
        }
    }
    public function validationRegistration($login, $password, $mail)
    {
        if ($this->userManager->isLoginFree($login)) {
            $passwordCrypt = password_hash($password, PASSWORD_DEFAULT);
            $account_key = rand(0, 999999);
            $this->registerAccount($login, $passwordCrypt, $mail, $account_key);
        } else {
            Tools::alertMessage("Pseudo déjà pris. Il faut en choisir un autre !", "orange");
            header('Location: ' . URL . 'registration');
        }
    }
}

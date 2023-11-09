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
                Tools::alertMessage("Compte en attente validation", "orange");
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
}

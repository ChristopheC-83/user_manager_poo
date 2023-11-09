<?php

require_once("./controllers/Main.controller.php");
require_once("./models/User/User.model.php");




class UserController extends MainManager
{
    private $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function validation_login($login, $password)
    {
        if ($this->userManager->isCombinationValid($login, $password)) {
            if ($this->userManager->isAccountValidated($login)) {
                Tools::alertMessage("You're welcome !", "green");
                $_SESSION['profile'] = ['login' => $login];
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
}

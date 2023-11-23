<?php

require_once("./controllers/Main.controller.php");
require_once("./models/User/User.model.php");




class UserController extends MainController
{
    public $userManager;
    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->userManager = new UserManager();
    }
    public function validation_login($login, $password)
    {
        $datasUser = $this->userManager->getUserInfo($login);

        if ($this->userManager->isCombinationValid($login, $password)) {
            if ($this->userManager->isAccountValidated($login)) {
                Tools::alertMessage("You're welcome !", "green");
                $_SESSION['profile']['login'] = $login;
                $_SESSION['profile']['role'] =  $datasUser['role'];
                $_SESSION['profile']['avatar'] =  $datasUser['avatar'];
                Tools::generateCookieConnection();
                header('Location: ' . URL . 'account/profile');
                // header('Location: ' . URL . 'account/profile');
            } else {
                Tools::alertMessage("Compte en attente validation", "orange");
                $msg = "<a href='resend_validation_mail/" . $login . "'>=> Renvoyer le mail de validation <=</a> ";
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
            "jsm" => ['profile_modify_mail.js', 'profile_delete_account.js', 'profile_modify_avatar.js'],
            "view" => "./views/User/profilePage.view.php",
            "template" => "./views/templates/template.php",

        ];
        $this->functions->generatePage($data_page);
    }
    public function logout()
    {
        unset($_SESSION['profile']);
        unset($_SESSION['profil']);
        setcookie(Tools::COOKIE_NAME, '', time() - 3600 * 24 * 365);
        if ($_SESSION['profile']) {
            Tools::alertMessage("La déconnexion a échoué.", "red");
        } else {
            Tools::alertMessage("Vous êtes bien déconnecté(e).", "green");
        }
        header('Location: ' . URL . 'home');
    }
    private function sendMailValidation($login, $mail, $account_key)
    {
        $urlValidation = URL . "mail_validation_account/" . $login . "/" . $account_key;
        $sujet = "Validez Compte Barpat";
        $message = "Validez votre compte sur le blog de Barpat ! Nous t'attendons ! Cliquez sur :" . $urlValidation;
        Tools::sendMail($mail, $sujet, $message);
    }
    public function resendValidationMail($login)
    {

        $datasUser = $this->userManager->getUserInfo($login);
        $this->sendMailValidation($login, $datasUser['mail'], $datasUser['account_key']);
        Tools::alertMessage("Mail de validation renvoyé !", "green");
        header('Location: ' . URL . 'connection');
    }
    private function registerAccount($login, $password, $mail, $account_key)
    {
        $avatar = "site/astroshiba.jpg";
        if ($this->userManager->registerAccountDB($login, $password, $mail, $account_key, $avatar)) {
            $this->sendMailValidation($login, $mail, $account_key);
            Tools::alertMessage("Compte créé ! Lien de validation envoyé par mail.", "green");
            header('Location: ' . URL . 'home');
        } else {
            Tools::alertMessage("La création a échoué, Réessayez !", "red");
            header('Location: ' . URL . 'registration');
        }
    }
    public function validationRegistration($login, $password, $mail)
    {
        if ($this->userManager->isLoginFree($login)) {
            $password_crypt = password_hash($password, PASSWORD_DEFAULT);
            $account_key = rand(0, 999999);
            $this->registerAccount($login, $password_crypt, $mail, $account_key);
        } else {
            Tools::alertMessage("Pseudo déjà pris. Il faut en choisir un autre !", "orange");
            header('Location: ' . URL . 'registration');
        }
    }
    private function accountAlreadyActivated($login)
    {
        $datasUser = $this->userManager->getUserInfo($login);
        return ((int)$datasUser['is_valid'] === 1);
    }
    public function validationAccountByLinkMail($login, $account_key)
    {
        if ($this->accountAlreadyActivated($login)) {
            $_SESSION['profile']['login'] = $login;
            Tools::alertMessage("Ton compte est déjà activé ! Connecte toi !", "green");
            header('Location: ' . URL . 'home');
        } else {
            if ($this->userManager->validationAccountDB($login, $account_key)) {
                $_SESSION['profile']['login'] = $login;
                Tools::alertMessage("Ton compte est activé ! Connecte toi !", "green");
                header('Location: ' . URL . 'home');
            } else {
                Tools::alertMessage("Echec de l'activation du compte, réessaye.", "red");
                header('Location: ' . URL . 'registration');
            }
        }
    }
    public function modifyMail($newMail)
    {
        if ($this->userManager->modifyMailDB($_SESSION['profile']['login'], $newMail)) {
            Tools::alertMessage("Adresse Mail modifiée avec succés.", "green");
        } else {
            Tools::alertMessage("Aucune modification de l'adresse mail.", "red");
        }
        header('Location: ' . URL . 'account/profile');
    }
    public function modifyPasswordPage()
    {
        $datasUser = $this->userManager->getUserInfo($_SESSION['profile']['login']);

        $data_page = [
            "page_description" => "Page de profil",
            "page_title" => "Page de profil",
            "datasUser" => $datasUser,
            "js" => ['passwordVerify.js'],
            "view" => "./views/User/modifyPasswordPage.view.php",
            "template" => "./views/templates/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
    public function validationNewPassword($old_password, $new_password)
    {
        if ($this->userManager->isCombinationValid($_SESSION['profile']['login'], $old_password)) {
            $password_crypt = password_hash($new_password, PASSWORD_DEFAULT);
            if ($this->userManager->modifyPasswordDB($_SESSION['profile']['login'], $password_crypt)) {
                Tools::alertMessage("Mot de Passe modifié.", "green");
                header('Location: ' . URL . 'account/profile');
            } else {
                Tools::alertMessage("Echec de la modification dun mot de passe.", "red");
                header('Location: ' . URL . 'account/modify_password');
            }
        } else {
            Tools::alertMessage("Ancien Mot de Passe erroné.", "red");
            header('Location: ' . URL . 'account/modify_password');
        }
    }
    public function sendNewPassword($old_password, $new_password, $verif_password)
    {
        if ($old_password === $new_password) {
            Tools::alertMessage("Vous avez remis le même mot de passe ! ", "orange");
            header('Location: ' . URL . 'account/modify_password');
        } else if ($new_password !== $verif_password) {
            Tools::alertMessage("Les nouveaux Mots de Passe ne correspondent pas ! ", "red");
            header('Location: ' . URL . 'account/modify_password');
        } else {
            $this->validationNewPassword($old_password, $new_password);
        }
    }
    public function deleteAccount()
    {
        $login = $_SESSION['profile']['login'];
        $this->deleteUserAvatar($login);
        rmdir("public/assets/images/avatars/users/" . $login);
        if ($this->userManager->deleteAccountDB($login)) {
            $this->logout();
            Tools::alertMessage("Suppression du compte effectuée. ", "green");
        } else {
            Tools::alertMessage("La suppression du compte a échoué. ", "red");
            header('Location: ' . URL . 'account/profile');
        }
    }
    public function forgotPasswordPage()
    {

        $data_page = [
            "page_description" => "mot de passe oublié",
            "page_title" => "mot de passe oublié",
            "jsm" => ['loader.js'],
            "view" => "./views/Visitor/forgotPasswordPage.view.php",
            "template" => "./views/templates/template.php",

        ];
        $this->functions->generatePage($data_page);
    }
    public function  isCombinationMailValid($login, $mail)
    {
        $maildBd = $this->userManager->getMailUser($login);
        if ($maildBd === $mail) {
            return true;
        } else {
            return false;
        }
    }
    public function sendNewPasswordAfterForgot($login, $newMdp)
    {
        $mdpCrypte = password_hash($newMdp, PASSWORD_DEFAULT);
        if ($this->userManager->modifyPasswordDB($login, $mdpCrypte)) {
            Tools::alertMessage("Mot de passe provisoire actif", "green");
        } else {
            Tools::alertMessage("Echec de la mise en place du nouveau mot de passe", "red");
        }
    }
    public function sendForgotPassword($login, $mail)
    {

        if (!$this->isCombinationMailValid($login, $mail)) {
            Tools::alertMessage("Pas de concordance, Merci de vérifier", "red");
            header('Location: ' . URL . 'forgot_password');
        } else {

            echo json_encode(['status' => 'success']);   //pour loader
            $newMdp = $this->functions->generateRandomPassword(20);
            $this->sendNewPasswordAfterForgot($login, $newMdp);
            $destinataire = $mail;
            $sujet = "on a oublié son mdp ?";
            $message = "on va résoudre ça ! \r\nEssaye avec : \r\n \r\n" . $newMdp . " \r\n \r\nChange le sur le site... lui tu ne risques pas de le retenir !";
            Tools::alertMessage("Nouveau mdp envoyé par mail", "green");
            Tools::sendMail($destinataire, $sujet, $message,);
            header('location:' . URL . "connection");
        }
    }
}

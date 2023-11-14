<?php


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
        $userController->modifyAvatarBySite($newAvatar);
        break;

    case "modify_image_by_perso":
        if ($_FILES['image']['size'] > 0) {
            $userController->modifyAvatarByPerso($_FILES['image']);
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

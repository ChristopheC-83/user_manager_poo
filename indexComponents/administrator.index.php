<?php 

switch ($url[1]) {
    case "rights_management":
        $administratorController->rightsManagement();
        break;
    case "modify_role":
        $login = Tools::secureHTML($_POST['login']);
        $newRole = Tools::secureHTML($_POST['role']);
        $administratorController->modifyRole($login, $newRole);
        break;
    case "modify_state":
        $login = Tools::secureHTML($_POST['login']);
        $is_valid = Tools::secureHTML($_POST['is_valid']);
        $administratorController->modifyState($login, $is_valid);
        break;
    case "delete_account_user":
        $login = Tools::secureHTML($_POST['login']);
        $administratorController->deleteAccountUser($login);
        break;

    default:
        throw new Exception("La page demandée n'existe pas...");
}
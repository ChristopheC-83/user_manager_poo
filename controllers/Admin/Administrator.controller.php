<?php

require_once("./controllers/Functions.controller.php");
require_once("./models/Admin/Administrator.model.php");




class AdminstratorController extends MainController
{
    public $functions;
    public $administratorManager;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->administratorManager = new AdministratorManager();
    }
    public function rightsManagement()
    {

        $infoUsers = $this->administratorManager->getUsers();

        $data_page = [
            "page_description" => "Page de gestion des droits",
            "page_title" => "Page de gestion des droits",
            "view" => "./views/Admin/rightsManagement.view.php",
            "js" => ['rightsManagement.js'],
            "infoUsers" => $infoUsers,
            "template" => "views/templates/template.php",

        ];
        $this->functions->generatePage($data_page);
    }

    public function modifyRole($login, $newRole)
    {

        if ($this->administratorManager->modifyRoleDB($login, $newRole)) {
            Tools::alertMessage("Succés de la modification du rôle", "green");
        } else {
            Tools::alertMessage("Echec de la modification du rôle", "red");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
    public function modifyState($login, $is_valid)
    {

        if ($this->administratorManager->modifyStateDB($login, $is_valid)) {
            Tools::alertMessage("Succés de la modification de l'état.", "green");
        } else {
            Tools::alertMessage("Echec de la modification de l'état.", "red");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
    public function deleteAccountUser($login)
    {
        $this->imagesManager->deleteUserAvatar($login);
        rmdir("public/assets/images/avatars/users/" . $login);
        if ($this->userManager->deleteAccountDB($login)) {
            Tools::alertMessage("Suppression compte effectuée", "green");
        } else {
            Tools::alertMessage("Echec de la suppression du compte.", "red");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
}

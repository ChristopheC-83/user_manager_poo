<?php

require_once("./controllers/Main.controller.php");
require_once("./models/User/User.model.php");
require_once("./models/Editor/Editor.model.php");
require_once("./models/Admin/Administrator.model.php");
require_once("./models/Images.model.php");




class AdminstratorController extends MainController
{
    private $userManager;
    private $imagesManager;
    public $functions;
    public $editorManager;
    public $administratorManager;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->imagesManager = new ImageController();
        $this->userManager = new UserManager();
        $this->editorManager = new EditorManager();
        $this->administratorManager = new AdministratorManager();
    }
    public function userAccounts(){
    
        echo "j'accède aux comptes.";
    }
   
}

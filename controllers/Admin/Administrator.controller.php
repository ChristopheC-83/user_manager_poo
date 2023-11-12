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
    public function userAccounts(){
    
        echo "j'accède aux comptes.";
    }
   
}

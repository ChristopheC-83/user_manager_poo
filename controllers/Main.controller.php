<?php

require_once("./controllers/Functions.controller.php");
require_once("./controllers/Tools.controller.php");
require_once("./models/Visitor/Visitor.model.php");



abstract class MainController
{

    // l'injection de cette dépendance permet d'utiliser 
    // dans les controller en charge d'afficher les pages les fonctions :
    // genererPage, afficherTableau, ajouterMessageAlerte

    public $visitorManager;
    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->visitorManager = new VisitorManager();
    }


    // homePage et errorPage sont communes à tous les visitors, users et admin
    //à rappeler dans les classes enfa,ts si besoin de personnaliser

    public function homePage()
    {
        $psw_hash = $this->functions->hashFunction("kiki");  // A enlever
        $users = $this->visitorManager->getUsers();          // A enlever

        $data_page = [
            "page_description" => "Description accueil",
            "page_title" => "titre accueil",
            "view" => "views/Visitor/homePage.view.php",
            "pws_hash" => $psw_hash,                             // A enlever
            "users" => $users,                                   // A enlever
            "template" => "views/templates/template.php",

        ];
        $this->functions->generatePage($data_page);
    }

    public function errorPage($msg)
    {

        $data_page = [
            "page_description" => "Erreur !",
            "page_title" => "Erreur !",
            "view" => "views/Visitor/errorPage.view.php",
            "template" => "views/templates/template.php",
            "msg" => $msg,
        ];
        $this->functions->generatePage($data_page);
    }
}

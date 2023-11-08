<?php

require_once("./controllers/Secure.controller.php");
require_once("./controllers/Functions.controller.php");
require_once("./models/Visitor/Visitor.model.php");
require_once("./controllers/Utilities.controller.php");



abstract class MainController
{

    // l'injection de cette dépendance permet d'utiliser 
    // dans les controller en charge d'afficher les pages les fonctions :
    // genererPage, afficherTableau, ajouterMessageAlerte

    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
    }


    // homePage et errorPage sont communes à tous les visitors, users et admin
    //à rappeler dans les classes enfa,ts si besoin de personnaliser

   

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

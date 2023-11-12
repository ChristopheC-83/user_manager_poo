<?php

// issu de ImagesController car utilisé à tous les niveaux

require_once("./controllers/Images.controller.php");
require_once("./controllers/Tools.controller.php");
require_once("./models/Visitor/Visitor.model.php");



abstract class MainController extends ImageController
{

    // l'injection de cette dépendance permet d'utiliser 
    // dans les controller en charge d'afficher les pages les fonctions :
    // genererPage, afficherTableau, ajouterMessageAlerte
    //Les injections ne se transmettent pas aux classes enfant !

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

        $data_page = [
            "page_description" => "Description accueil",
            "page_title" => "titre accueil",
            "view" => "views/Visitor/homePage.view.php",
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

<?php

// issu de ImagesController car utilisé à tous les niveaux

// Tous les controllers (sauf images) sont issus de MainController. Ils sont indépendants les uns des autres.
// Les managers découlent les une des autres pour récupérer les méthodes et ne pas appeler tous les managers dans chaque controller !

require_once("./controllers/Images.controller.php");
require_once("./controllers/Tools.controller.php");
require_once("./models/Visitor/Visitor.model.php");



class MainController extends ImageController
{

    // l'injection de cette dépendance permet d'utiliser dans les controller les fonctions :
    // genererPage, afficherTableau, ajouterMessageAlerte
    //Les injections ne se transmettent pas aux classes enfant !
    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
    }


    // homePage et errorPage sont communes à tous les utilisateurs de tous les roles (visiteurs, utilisateurs, admin...)
    //à rappeler dans les classes enfants si besoin de personnaliser

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

<?php

require_once("./models/MainManager.model.php");

require_once("./controllers/Functions.controller.php");



class MainController
{

    // l'injection de cette dépendance permet d'utiliser 
    // dans les controller en charge d'afficher les pages les fonctions :
    // genererPage, afficherTableau, ajouterMessageAlerte
    // private $functions;
    private $mainManager;
    private $functions;
    public function __construct()
    {
        $this->mainManager = new MainManager(); // de MainManager.model.php
        $this->functions = new Functions(); 
    }
    // mainController répertorie les pages avec leurs infos respectives

    public function pageAccueil()
    {


        $data_page = [
            "page_description" => "Description accueil",
            "page_title" => "titre accueil",
            "view" => "views/pages/public/accueil.view.php",
            "template" => "views/commons/template.php",
            "css" => "accueilContainer",
            "variable_de_demo" => "demo de variable"

        ];
        $this->functions->genererPage($data_page);
    }
    public function pageErreur($msg)
    {

        $data_page = [
            "page_description" => "Erreur !",
            "page_title" => "Erreur !",
            "view" => "views/pages/public/erreur.view.php",
            "template" => "views/commons/template.php",
            "msg" => $msg,
        ];
        $this->functions->genererPage($data_page);
    }
   
}

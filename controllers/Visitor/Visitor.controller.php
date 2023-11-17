<?php

require_once("./controllers/Main.controller.php");
require_once("./models/Visitor/Visitor.model.php");

class VisitorController extends MainController
{
    public $visitorManager;
    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->visitorManager = new VisitorManager();
    }
    public function connectionPage()
    {
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "view" => "views/Visitor/connectionPage.view.php",
            "template" => "views/templates/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
    public function registrationPage()
    {
        $data_page = [
            "page_description" => "Page de création de compte",
            "page_title" => "Page de création de compte",
            "jsm" => ['loader.js'],
            "view" => "views/Visitor/registrationPage.view.php",
            "template" => "views/templates/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
}

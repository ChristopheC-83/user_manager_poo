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

    public function homePage()
    {
        $psw_hash = $this->functions->hashFunction("kiki");
        $users = $this->visitorManager->getUsers();

        $data_page = [
            "page_description" => "Description accueil",
            "page_title" => "titre accueil",
            "view" => "views/Visitor/homePage.view.php",
            "pws_hash" => $psw_hash,
            "users" => $users,
            "template" => "views/templates/template.php",

        ];
        $this->functions->generatePage($data_page);
    }
}

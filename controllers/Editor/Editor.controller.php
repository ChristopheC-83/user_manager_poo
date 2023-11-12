<?php

require_once("./controllers/Main.controller.php");
require_once("./models/User/User.model.php");
require_once("./models/Editor/Editor.model.php");
require_once("./models/Images.model.php");




class EditorController extends MainController
{
    private $userManager;
    private $imagesManager;
    public $functions;
    public $editorManager;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->imagesManager = new ImageController();
        $this->userManager = new UserManager();
        $this->editorManager = new EditorManager();
    }

    public function writeArticle(){
    
        echo "j'écris un article";
    }
   
}

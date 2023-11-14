<?php

require_once("./controllers/Functions.controller.php");
require_once("./models/Editor/Editor.model.php");

class EditorController extends MainController
{
    public $functions;
    public $editorManager;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->editorManager = new EditorManager();
    }
    public function writeArticle(){
    
        echo "j'écris un article";
    }
}

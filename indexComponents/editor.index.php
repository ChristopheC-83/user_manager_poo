<?php 

switch ($url[1]) {
    case "write_article":
        $editorController->writeArticle();
        break;

    default:
        throw new Exception("La page demandée n'existe pas...");
}
<?php

// fichier avec des fonctions utilitaires

class Functions 
{
    public function generatePage($data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    public function showArray($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    public function alertMessage($message, $type)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
    }
}

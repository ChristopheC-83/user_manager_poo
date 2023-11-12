<?php

// fichier avec des fonctions récurrentes
// importé par injection de dépendances dzans chaque classe controller

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

    public function hashFunction($psw)
    {
        $hashedPsw = password_hash($psw, PASSWORD_DEFAULT);
        return $hashedPsw;
    }
};

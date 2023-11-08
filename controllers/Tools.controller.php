<?php

// fichier avec des fonctions utilitaires ponctuelles
abstract class Tools
{
    public static function showArray($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    public static function alertMessage($message, $type)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
    }
}

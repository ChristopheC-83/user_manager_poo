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
    public static function secureHTML($string)
    {
        return htmlentities($string);
    }
    public static function isConnected()
    {
        return (!empty($_SESSION['profile']));
    }
    public static function isUser()
    {
        return ($_SESSION['profile']['role'] === "user" ||
            $_SESSION['profile']['role'] === "editor" ||
            $_SESSION['profile']['role'] === "admin"
        );
    }
    public static function isEditor()
    {
        return ($_SESSION['profile']['role'] === "editor" ||
            $_SESSION['profile']['role'] === "admin");
    }
    public static function isAdministrator()
    {
        return ($_SESSION['profile']['role'] === "admin");
    }
    public static function sendMail($to, $subject, $message)
    {
        $headers = "From : christophe@barpat.fun";
        if (mail($to, $subject, $message, $headers)) {
            Tools::alertMessage("Mail envoyé.", "green");
        } else {
            Tools::alertMessage("Mail non envoyé.", "red");
        }
    }
}

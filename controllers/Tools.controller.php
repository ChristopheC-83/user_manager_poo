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
        return (!empty($_SESSION['profile']['role']));
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
    public const COOKIE_NAME = "memory";

    public static function  generateCookieConnection()
    {
        $ticket = session_id() . microtime() . rand(0, 999999);
        $ticket = hash("sha512", $ticket);
        setCookie(self::COOKIE_NAME, $ticket, time() + (60*60*24));
        $_SESSION['profile'][self::COOKIE_NAME] = $ticket;
    }
    public static function  checkCookieConnection()
    {
        return $_COOKIE[self::COOKIE_NAME] === $_SESSION['profile'][self::COOKIE_NAME];
    }
    public static function  badCookie()
    {
        Tools::alertMessage("Veuillez vous reconnecter.", "orange");
        setcookie(Tools::COOKIE_NAME, "", time()-3600);
        unset($_SESSION['profile']);
        header('Location: ' . URL . 'connection');
    }
}

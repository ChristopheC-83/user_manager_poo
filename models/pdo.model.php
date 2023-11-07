<?php



// fichier de connexion à bdd
require_once("./models/donnees_perso.model.php");

abstract class Model
{

    private static $pdo;
    public static function setBDD()
    {
        try {
            //connexion à notre BDD, à modifier pour site en construction
            self::$pdo = new PDO(
                "mysql:host=" . mysql . ";dbname=" . dbname,
                user,
                mdpbd,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING] //ou ERRMODE_EXCEPTION à la place de WARNING
            );
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return self::$pdo;
    }

    protected function getBDD()
    {
        // self::$pdo = self::setBDD();
        if (self::$pdo === null) {
            self::setBDD();
        }
        return self::$pdo;
    }
}

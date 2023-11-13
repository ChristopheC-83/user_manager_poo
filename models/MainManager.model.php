<?php
// les modelsManager permettent la récupéretion, le traitement des données
// ils gèrent aussi la partie logique du site.
// Il est issu de ImagesManager (issu de Model), car ImagesManager utiles partout !

require_once("./models/Images.model.php");
class MainManager extends ImagesManager
{
    public function getThemes()
    {
        $req = "SELECT * FROM themes ORDER BY id_theme asc";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->execute();
        $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $infos;
    }
    public function getUsers()
    {
        $req = "SELECT * FROM users ";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->execute();
        $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $infos;
    }
}

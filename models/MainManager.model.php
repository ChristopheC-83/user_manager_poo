<?php
// les modelsManager permettent la récupéretion, le traitement des données
// ils gèrent aussi la partie logique du site.

require_once("./models/pdo.model.php");
class MainManager extends Model
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
}

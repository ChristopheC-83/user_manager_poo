<?php


require_once("./models/MainManager.model.php");

class EditorManager extends MainManager
{
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

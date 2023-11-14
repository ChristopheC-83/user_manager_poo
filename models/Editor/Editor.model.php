<?php


require_once("./models/User/User.model.php");

class EditorManager extends UserManager
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

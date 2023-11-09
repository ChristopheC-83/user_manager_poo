<?php


require_once("./models/MainManager.model.php");

class UserManager extends MainManager
{
    private function getPasswordUser($login)
    {
        $req = "SELECT password FROM users WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
    }

    public function isCombinationValid($login, $password)
    {
        $passwordDB = $this->getPasswordUser($login);
        return password_verify($password, $passwordDB);
    }




    public function isAccountValidated($login)
    {
        $req = "SELECT is_valid FROM users WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ((int)$resultat['is_valid'] === 1 ? true : false);
    }

}

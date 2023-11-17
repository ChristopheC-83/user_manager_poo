<?php


require_once("./models/MainManager.model.php");

class UserManager extends MainManager
{
    public function getPasswordUser($login)
    {
        $req = "SELECT password FROM users WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
    }
    public function getMailUser($login)
    {
        $req = "SELECT mail FROM users WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['mail'];
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
    public function getUserInfo($login)
    {
        $req = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
    public function isLoginFree($login)
    {
        return (empty($this->getUserInfo($login)));
    }
    public function registerAccountDB($login, $password, $mail, $account_key, $avatar)
    {
        $req = "INSERT INTO users (login, password, mail, is_valid, role, account_key, avatar, avatar_site)
        VALUES(:login, :password, :mail, 0, 'user', :account_key, :avatar, 1)
        ";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":account_key", $account_key, PDO::PARAM_INT);
        $stmt->bindValue(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->execute();
        $isCreate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isCreate;
    }
    public function validationAccountDB($login, $account_key)
    {
        $req = "UPDATE users set is_valid = 1 WHERE login= :login and account_key= :account_key ";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":account_key", $account_key, PDO::PARAM_INT);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }
    public function modifyMailDB($login, $mail)
    {
        $req = "UPDATE users set mail = :mail WHERE login= :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }
    public function modifyPasswordDB($login, $password)
    {
        $req = "UPDATE users set password = :password WHERE login= :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }

    public function deleteAccountDB($login)
    {
        $req = "DELETE FROM users WHERE login= :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }
}

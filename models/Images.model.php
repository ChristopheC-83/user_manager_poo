 <?php

require_once("./models/pdo.model.php");

class ImagesManager extends Model
{


    public function getImageSiteUser($login)
    {
        $req = "SELECT avatar_site FROM users WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['avatar_site'];
    }
    public function getImageUser($login)
    {
        $req = "SELECT avatar FROM users WHERE login = :login";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['avatar'];
    }
    public function ModifyAvatarDB($login, $avatar, $avatar_site)
    {
        $req = "UPDATE users set avatar = :avatar, avatar_site = :avatar_site
                    WHERE login = :login
                    ";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->bindValue(":avatar_site", $avatar_site, PDO::PARAM_INT);
        $stmt->execute();
        $validationOk = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $validationOk;
    }
    public function addImageDB($login, $avatar, $avatar_site)
    {
        $req = "UPDATE users set avatar = :avatar, avatar_site = :avatar_site
                WHERE login = :login
                ";
        $stmt = $this->getBDD()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->bindValue(":avatar_site", $avatar_site, PDO::PARAM_INT);
        $stmt->execute();
        $validationOk = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $validationOk;
    }
}

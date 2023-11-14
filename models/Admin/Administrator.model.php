<?php


require_once("./models/Editor/Editor.model.php");

class AdministratorManager extends EditorManager
{
   public function modifyRoleDB($login, $role){

    $req = "UPDATE users set role = :role WHERE login= :login ";
    $stmt = $this->getBDD()->prepare($req);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->bindValue(":role", $role, PDO::PARAM_STR);
    $stmt->execute();
    $isValidate = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $isValidate;

}
   public function modifyStateDB($login, $is_valid){

    $req = "UPDATE users set is_valid = :is_valid WHERE login= :login ";
    $stmt = $this->getBDD()->prepare($req);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->bindValue(":is_valid", $is_valid, PDO::PARAM_INT);
    $stmt->execute();
    $isValidate = ($stmt->rowCount() > 0);
    $stmt->closeCursor();
    return $isValidate;

}
}

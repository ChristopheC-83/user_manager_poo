<?php

require_once("./models/User/User.model.php");

class ImageController
{


    public $userManager;
    public function __construct()
    {
        $this->userManager = new ImagesManager();
    }

    public function deleteUserAvatar($login)
    {
        if ($this->userManager->getImageSiteUser($login)==0) {
            $oldAvatar = $this->userManager->getImageUser($login);
            unlink("public/assets/images/avatars/" . $oldAvatar);
        }
        return;
    }
    public function modifyAvatarByPerso($file)
    {
        $this->deleteUserAvatar($_SESSION['profile']['login']);
        try {
            $repertoire ="public/assets/images/avatars/users/"  . $_SESSION['profile']['login'] . "/";
            $nomImage = $this->addImage($file, $repertoire);
            $nomImageBd = "users/" . $_SESSION['profile']['login'] . "/" . $nomImage;
            if ($this->userManager->addImageDB($_SESSION['profile']['login'], $nomImageBd, 0)) {
            $_SESSION['profile']['avatar'] = $nomImageBd;
                header('location:' . URL . "account/profile");
            } else {
                Tools::alertMessage("Modfication de l'image non effectuée.", "rouge");
                header('location:' . URL . "account/profile");
            }
        } catch (Exception $e) {
            Tools::alertMessage($e->getMessage(), "red");
            header('location:' . URL . "account/profile");
        }
    }

    public function addImage($file, $repertoire)
    {
        if (!isset($file['name']) || empty($file['name'])) {
            throw new Exception("Vous devez sélectionner une image.");
        }
    
        if (!file_exists($repertoire)) mkdir($repertoire, 0777, true);
    
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $random = rand(0, 999999);
        $target_file = $repertoire . "/". $random . "_" . $file['name'];
    
        if (!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnue");
        if (file_exists($target_file))
            throw new Exception("Le fichier existe déjà.");
        if ($file['size'] > 500000)
            throw new Exception("Le fichier est trop volumineux (500ko maximum).");
        if (!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("L'ajout de l'image n'a pas fonctionné");
        else return ($random . "_" .$file['name']);
    }
    



    public function modifyAvatarBySite($avatar)
    {
        $this->deleteUserAvatar($_SESSION['profile']['login']);
        $linkAvatar = "site/" . $avatar;
        if ($this->userManager->ModifyAvatarDB($_SESSION['profile']['login'], $linkAvatar, 1)) {
            $_SESSION['profile']['avatar'] = $linkAvatar;
            header('location:' . URL . "account/profile");
        } else {
            Tools::alertMessage("Modification de l'image non effectuée.", "red");
            header('location:' . URL . "account/profile");
        }
    }
}

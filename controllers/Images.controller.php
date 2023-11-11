<?php

require_once("./models/Images.model.php");

class ImageController
{


    public $imagesManager;
    private $userManager;
    public function __construct()
    {
        $this->imagesManager = new ImagesManager();
        $this->userManager = new UserManager();
    }

    public function deleteUserAvatar($login)
    {
        if ($this->imagesManager->getImageUser($login)) {
            $oldAvatar = $this->imagesManager->getImageUser($login);
            unlink("public/assets/images/avatars/" . $oldAvatar);
        }
    }
    public function modifyAvatarByPerso($file)
    {
        try {
            $repertoire ="public/assets/images/avatars/users/"  . $_SESSION['profile']['login'] . "/";
            $nomImage = $this->addImage($file, $repertoire);
            $this->deleteUserAvatar($_SESSION['profile']['login']);
            $nomImageBd = "users/" . $_SESSION['profile']['login'] . "/" . $nomImage;
            if ($this->imagesManager->addImageDB($_SESSION['profile']['login'], $nomImageBd, 0)) {
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
    
        $target_file = $repertoire . "/" . $file['name'];
    
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
        else return ($file['name']);
    }
    



    public function modifyAvatarBySite($avatar)
    {
        $avatarSite = $this->userManager->getUserInfo($_SESSION['profile']['login'])['avatar_site'];
        if (!$avatarSite) {
            $this->deleteUserAvatar($_SESSION['profile']['login']);
        }
        $linkAvatar = "site/" . $avatar;
        if ($this->imagesManager->ModifyAvatarDB($_SESSION['profile']['login'], $linkAvatar, 1)) {
            header('location:' . URL . "account/profile");
        } else {
            Tools::alertMessage("Modification de l'image non effectuée.", "red");
            header('location:' . URL . "account/profile");
        }
    }
}

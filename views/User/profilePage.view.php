<div class="container">
    <h1><?= $datasUser['login'] ?> : votre page de Profil.</h1>

    <div class="containerForm">
        <div class="avatarContainer">
            <img src="<?= URL ?>public/assets/images/avatars/<?= $datasUser['avatar'] ?>" alt="user's avatar" class="profil_avatar">
        </div>


        <div class="blockProfile infoProfile">

            <form action="<?= URL ?>account/modify_image_by_perso" enctype="multipart/form-data" method="post" class="formChangeAvatar">
                <label for="image">
                    <p>Changer votre avatar <br>par une image perso</p>
                    <i class="fa-solid fa-repeat" id="btn_modif_img_perso"></i>
                </label><br>
                <input type="file" id="image" name="image" onchange="submit()" value="Parcourir" class="dnone">
            </form>

            <form action="" method="post" class="formChangeAvatar">
                <label>
                    <p>Changer votre avatar <br>par une image du site</p>
                    <i class="fa-solid fa-repeat" id="btn_modif_img_site"></i>
                </label><br>
            </form>


        </div>





        <div class="blockProfile" id="blockModifyMail">
            <div class="infoProfile">
                <p><b>Votre adresse mail : </b></p>
                <p><?= $datasUser['mail'] ?></p>
                <i class="fa-solid fa-pen" id="btnModifyMail"></i>
            </div>
            <form action="<?= URL ?>account/modify_mail" method="POST" class="dnone" id="formModifyMail">
                <div class="entryForm">
                    <label for="new_mail">Nouvelle adresse Mail :</label>
                    <input type="mail" name="new_mail" id="new_mail" value=<?= $datasUser['mail'] ?>>
                    <button type="submit">
                        <p>Je valide mon nouveau Mail !</p>
                    </button>
                </div>
            </form>
        </div>


        <div class="infoProfile">
            <p><b>Votre statut : </b></p>
            <p><?php if ($datasUser['role'] === 'user') {
                    echo 'Utilisateur';
                } elseif ($datasUser['role'] === 'editor') {
                    echo 'Editeur';
                } elseif ($datasUser['role'] === 'admin') {
                    echo 'Administrateur';
                }
                ?></p>
        </div>




        <?php if ( Tools::isEditor()) : ?>
            <div class="infoProfile">
                <div class="modifyPasswordPage">
                    <a href="<?= URL ?>editor/write_article">
                        <div class="btnModifyPasswordPage">
                            <p>J'écris un article.</p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif ?>
        <?php if (Tools::isAdministrator()) : ?>
            <div class="infoProfile">
                <div class="modifyPasswordPage">
                    <a href="<?= URL ?>administrator/rights_management">
                        <div class="btnModifyPasswordPage">
                            <p>Accés aux comptes utilisateurs</p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif ?>

        <div class="infoProfile">
            <div class="modifyPasswordPage">
                <a href="<?= URL ?>account/modify_password">
                    <div class="btnModifyPasswordPage">
                        <p>Je modifie mon Mot de Passe</p>
                    </div>
                </a>
            </div>
        </div>

        <?php if (!Tools::isAdministrator()) : ?>
            <div class="infoProfile">
                <div class="modifyPasswordPage">
                    <div class="btnModifyPasswordPage" id="openModalDeleteAcount">
                        <p>Je veux supprimer mon compte.</p>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div class="deleteValidationModale containerForm dnone">
            <h3>Cette action sera irréversible !</h3>
            <div class="btnModifyPasswordPage">
                <a href="<?= URL ?>account/delete_account">
                    <p>Suppression définitive validée.</p>
                </a>
            </div>
            <div class="btnModifyPasswordPage" id="closeModalDeleteAcount">
                <h4>Annulez ! Je reste !</h4>
            </div>
        </div>






    </div>

   


    <div class="images_site dnone">
        <?php
        $dossier = "public/assets/images/avatars/site";
        // Liste des fichiers dans le dossier
        $fichiers = scandir($dossier);
        ?>
        <?php foreach ($fichiers  as $fichier) :
            // Vérifie si le fichier est une image
            if (in_array(pathinfo($fichier, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif'))) :
        ?>
                <div class="image_site">
                    <a href="<?= URL ?>account/modify_avatar_by_site/<?= $fichier ?>">
                        <img src="<?= URL ?>/public/assets/images/avatars/site/<?= $fichier ?>">
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach ?>
    </div>
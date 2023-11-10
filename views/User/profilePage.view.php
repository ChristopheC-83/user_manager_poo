<div class="container">
    <h1><?= $datasUser['login'] ?> : votre page de Profil.</h1>

    <div class="containerForm">
        <div class="avatarContainer">
            <img src="<?=URL?>public/assets/images/avatars/<?= $datasUser['avatar'] ?>" alt="user's avatar" class="profil_avatar">
            <a href=""><i class="fa-solid fa-repeat" id="btnModifyAvatar"></i></a>
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
            <div class="modifyPasswordPage">
                <a href="<?= URL ?>account/modify_password">
                    <div class="btnModifyPasswordPage">
                        <p>Je modifie mon Mot de Passe</p>
                    </div>
                </a>
            </div>

        </div>
        <div class="infoProfile">
            <div class="modifyPasswordPage">
                <div class="btnModifyPasswordPage" id="openModalDeleteAcount">
                    <p>Je veux supprimer mon compte.</p>
                </div>
            </div>
        </div>

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

    <div class="">


        <?php
        Tools::showArray($datasUser);
        ?>
        <?php
        Tools::showArray($_SESSION);
        ?>

    </div>
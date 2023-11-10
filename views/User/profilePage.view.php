<div class="container">
    <h1><?= $datasUser['login'] ?> : votre page de Profil.</h1>

    <div class="containerForm">
        <div class="blockProfile" id="blockModifyMail">
            <div class="infoProfile">
                <p><b>Votre adresse mail : </b></p>
                <p><?= $datasUser['mail'] ?></p>
                <i class="fa-solid fa-pen" id="btnModifyMail"></i>
            </div>
            <form action="<?=URL?>account/modify_mail" method="POST" class="dnone" id="formModifyMail">
                <div class="entryForm">
                    <label for="new_mail">Nouvelle adresse Mail :</label>
                    <input type="mail" name="new_mail" id="new_mail" value=<?= $datasUser['mail'] ?>>
                    <button type="submit">
                        <p>Je valide</p>
                    </button>
                </div>
            </form>
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
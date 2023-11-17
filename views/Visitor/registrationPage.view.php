<div class="container">
    <h1>Création d'un Compte</h1>

    <form action="<?= URL ?>validation_registration" method="POST" class="containerForm">

        <div class="entryForm">
            <label for="login">Pseudo</label>
            <input type="text" name="login" id="login">
        </div>

        <div class="entryForm">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password">
        </div>


        <!-- si besoin -->
        <!-- <div class="entryForm">
            <label for="password_verification">Vérification du Mot de Passe</label>
            <input type="password" name="password_verification" id="password_verification">
        </div> -->

        <div class="entryForm">
            <label for="mail">Adresse Mail</label>
            <input type="mail" name="mail" id="mail">
        </div>

        <div class="entryForm" id="btnRegistration">
            <button type="submit">
                <p>Je crée mon compte</p>
            </button>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>connection">
                <h4>J'ai un compte ! Je me connecte ICI !</h4>
            </a>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>forgot_password">
                <h4>J'ai un compte ! Mais j'ai oublié le mot de passe...</h4>
            </a>
        </div>

    </form>


</div>
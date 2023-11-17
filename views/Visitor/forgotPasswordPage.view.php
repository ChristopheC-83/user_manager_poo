<div class="container">
    <h1>Mot de passe oublié ?</h1>

    <form action="<?= URL ?>send_forgot_password" method="POST" class="containerForm">

        <div class="entryForm">
            <label for="login">Pseudo</label>
            <input type="text" name="login" id="login">
        </div>

        <div class="entryForm">
            <label for="mail">Adresse Mail</label>
            <input type="mail" name="mail" id="mail">
        </div>

        <div class="entryForm">
            <button type="submit" id="btnForgotPassword">
                <p>Envoi nouveau mot de passe</p>
            </button>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>registration">
                <h4>En fait, je n'ai pas de compte. Je veux le créer !</h4>
            </a>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>connection">
                <h4>Je m'en souviens ! Je me connecte ICI !</h4>
            </a>
        </div>

    </form>


</div>
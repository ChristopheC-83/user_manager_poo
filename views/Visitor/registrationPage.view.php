<div class="container">
    <h1>Création d'un Compte</h1>

    <form action="<?= URL ?>validation_login" method="POST" class="containerForm">

        <div class="entryForm">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo">
        </div>
        <div class="entryForm">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="entryForm">
            <button type="submit">
                <p>Connexion</p>
            </button>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>registration">
                <h4>Pas de compte ? Cliquez ICI !</h4>
            </a>
        </div>
        <div class="entryForm">
            <a href="<?= URL ?>forgotPassword">
                <h4>Mot de passe oublié ? Cliquez L&Agrave;!</h4>
            </a>
        </div>
    </form>


</div>
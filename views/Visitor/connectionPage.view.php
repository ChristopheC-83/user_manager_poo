<div class="container">
    <h1>Connexion</h1>

    <form action="<?= URL ?>validation_login" method="POST" class="containerForm">

        <div class="entryForm">
            <label for="login">Pseudo</label>
            <input type="text" name="login" id="login">
        </div>
        <div class="entryForm">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password">
        </div>
       
        <div class="entryForm">
            <button type="submit">
                <p>Je me connecte</p>
            </button>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>registration">
                <h4>Je crée mon compte pour interagir avec tout le monde !</h4>
            </a>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>forgot_password">
                <h4>J'ai oublié mon mot de passe !</h4>
            </a>
        </div>
    </form>


</div>
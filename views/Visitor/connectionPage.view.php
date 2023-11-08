<div class="container">
    <h1>Page de Connexion</h1>

    <form action="<?= URL ?>validation_login" method="POST" class="container containerForm">

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

    </form>

</div>
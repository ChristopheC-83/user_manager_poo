<div class="container">
    <h1>Modifiez votre Mot de Passe</h1>

    <form action="<?= URL ?>account/send_new_password" method="POST" class="containerForm">

        <div class="entryForm">
            <label for="password">Ancien Mot de Passe</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="entryForm">
            <label for="new_password">Nouveau Mot de Passe</label>
            <input type="password" name="new_password" id="new_password">
        </div>
        <div class="entryForm">
            <label for="verif_password">Vérification nouveau Mot de Passe</label>
            <input type="password" name="verif_password" id="verif_password">
        </div>
        <h4 class="erreurPassword blind">Erreurs de saisies pour votre nouveau mot de passe !</h4>
       
        <div class="entryForm">
            <button type="submit" class="disabled" id="btnValidationPassword" >
                <p>Je valide le nouveau Mot de Passe.</p>
            </button>
        </div>

        <div class="entryForm">
            <a href="<?= URL ?>account/profile">
                <h4>Je ne veux pas changer mon Mot de Passe.</h4>
            </a>
        </div>

        
    </form>






    </div>

   
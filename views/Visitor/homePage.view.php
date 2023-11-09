<div class="">

    <h1>Titre Site / Accueil</h1>
    <h2>Accueil Contiendra</h2>

    <p>Contenu Accueil</p>
    <p>mot de passe crypté</p>
    <?= $pws_hash  ?>
    <br>
    <?= Tools::showArray($users)  ?>
    <br>
    <?= Tools::showArray($_SESSION)  ?>

</div>
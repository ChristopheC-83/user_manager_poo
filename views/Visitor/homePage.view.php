<div class="">

    <h1>Titre Site / Accueil</h1>
    <h2>Accueil Contiendra</h2>

    <p>Contenu Accueil</p>
    <p>mot de passe crypté</p>
    <?= $pws_hash  ?>
    <br>
    <br>
    <?= Tools::showArray($_SESSION)  ?>

    <?=Tools::isConnected()? "true" : "false"?>

</div>
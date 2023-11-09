<div class="">

    <h1>Page de Profil de <?=$datasUser['login'] ?> </h1>

    <?php
    Tools::showArray($datasUser);
    ?>
    <?php
    Tools::showArray($_SESSION);
    ?>

</div>
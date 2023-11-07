<?php
if (empty($_GET['page'])) {
   $url[0] = "accueil";
} else {
   $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
   $page = $url[0];
}

require_once("./controllers/Main.controller.php");
$mainManager = new MainManager();
$themes = $mainManager-> getThemes();

?>
<div class="btnThemesContainer">



   <a href="<?= URL ?>accueil" class="btnTheme all_themes 
      <?=
      (empty($url[0]) || $url[0] === 'accueil') ? 'selected_theme' : '';
      ?>
   " >
      <p>Accueil</p>
   </a>

   <?php foreach ($themes as $theme) : ?>
      <a href="<?= URL ?>theme/<?= $theme['theme'] ?>" class="btnTheme
       <?= $theme['theme'] ?> 
       <?= $url[1] === $theme['theme'] ? 'selected_theme' : '' ?>" >
         <p><?= $theme['theme'] ?></p>
      </a>
   <?php endforeach ?>

   <a href="<?= URL ?>connexion" class="btnTheme all_themes connexion 
      <?=$url[0] === 'connexion' ? 'selected_theme' : '';
      ?>
   " >
      <p>Connexion</p>
   </a>

</div>


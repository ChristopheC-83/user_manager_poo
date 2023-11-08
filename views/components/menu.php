<?php
if (empty($_GET['page'])) {
   $url[0] = "accueil";
} else {
   $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
   $page = $url[0];
}

require_once("./models/MainManager.model.php");
$mainManager = new MainManager();
$themes = $mainManager-> getThemes();

?>
<div class="btnThemesContainer">



   <a href="<?= URL ?>home" class="btnTheme all_themes 
      <?=
      (empty($url[0]) || $url[0] === 'home') ? 'selected_theme' : '';
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

   <a href="<?= URL ?>connection" class="btnTheme all_themes connection 
      <?=$url[0] === 'connection' ? 'selected_theme' : '';
      ?>
   " >
      <p>Connexion</p>
   </a>

</div>


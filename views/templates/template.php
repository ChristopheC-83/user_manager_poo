<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="description" content="<?= $page_description ?>">
    <link rel="stylesheet" href="<?= URL ?>public/style/style.css">
    <title><?= $page_title ?></title>
</head>

<body class="body">

    <?php require_once("views/components/overlay.php") ?>

    <?php require_once("views/components/header.php") ?>


    <div class="btn_menu_responsive ">
        <i class="fa-solid fa-circle-arrow-right arrow_btn"></i>
        <?php if (!empty($_SESSION['profile'])) : ?>
            <a href="<?= URL ?>account/profile"><img src="<?= URL . "public/assets/images/avatars/" . $_SESSION['profile']['avatar'] ?>" class="avatar_menu avatar_menu_resp"></a>
        <?php else : ?>

            <a href="<?= URL ?>connection">
                <i class="fa-regular fa-user unconnected_user"></i>
            </a>
        <?php endif ?>

    </div>

    <div class="containing">
        <div class="content">
            <?php
            if (!empty($_SESSION['alert'])) {
                foreach ($_SESSION['alert'] as $alert) {
                    echo "<div class='alert " . $alert['type'] . "' role='alert'><h3>
                        " . $alert['message'] . "
                    </h3></div>";
                }
                unset($_SESSION['alert']);
            }
            ?>
            <?= $page_content ?>
        </div>
        <?php require_once("views/components/footer.php") ?>
    </div>




    <?php if (!empty($js)) : ?>
        
        <?php foreach ($js as $jsFile) : ?>
            <script src="<?= URL ?>public/javascript/<?= $jsFile ?>"> </script>
        <?php endforeach ?>
    <?php endif ?>
    <?php if (!empty($jsm)) : ?>
        
        <?php foreach ($jsm as $jsFile) : ?>
            <script type="module" src="<?= URL ?>public/javascript/<?= $jsFile ?>"> </script>
        <?php endforeach ?>
    <?php endif ?>


    <script type="module" src="<?= URL ?>public/javascript/menu_responsive.js"></script>
    <script src="<?= URL ?>public/javascript/alert.js"></script>
    <script src="<?= URL ?>public/javascript/darkMode.js"></script>
</body>

</html>
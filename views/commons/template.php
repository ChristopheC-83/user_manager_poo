<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <meta name="description" content="<?= $page_description ?>">
    <link rel="stylesheet" href="<?= URL ?>public/style/style.css">
    <title><?= $page_title ?></title>
</head>

<body class="body">

    <?php require_once("views/commons/overlay.php") ?>

    <?php require_once("views/commons/header.php") ?>





    <div class="containing">
        <div class="content">
            <?php
            if (!empty($_SESSION['alert'])) {
                foreach ($_SESSION['alert'] as $alert) {
                    echo "<div class='alert " . $alert['type'] . "' role='alert'>
                        " . $alert['message'] . "
                    </div>";
                }
                unset($_SESSION['alert']);
            }
            ?>
            <?= $page_content ?>
        </div>
        <?php require_once("views/commons/footer.php") ?>
    </div>




    <?php if (!empty($js)) : ?>
        <?php foreach ($js as $fichierJS) : ?>
            <script src="<?= URL ?>public/javascript/<?= $fichierJS ?>"> </script>
        <?php endforeach ?>
    <?php endif ?>


    <script src="./public/javascript/alert.js"></script>
    <script src="./public/javascript/darkMode.js"></script>
</body>

</html>
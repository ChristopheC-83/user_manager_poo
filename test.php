<?php

echo ('$imagesController');
echo "<br>";
$reflexion = new ReflectionClass($imagesController);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$mainController');
echo "<br>";
$reflexion = new ReflectionClass($mainController);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$visitorController');
echo "<br>";
$reflexion = new ReflectionClass($visitorController);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$userController');
echo "<br>";
$reflexion = new ReflectionClass($userController);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$editorController');
echo "<br>";
$reflexion = new ReflectionClass($editorController);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$administratorController');
echo "<br>";
$reflexion = new ReflectionClass($administratorController);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";

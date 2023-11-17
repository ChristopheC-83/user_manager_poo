<?php 

require_once("./models/Admin/Administrator.model.php");
require_once("./models/Editor/Editor.model.php");
require_once("./models/User/User.model.php");
require_once("./models/Visitor/Visitor.model.php");
require_once("./models/MainManager.model.php");
require_once("./models/Images.model.php");
$imageManager = new ImagesManager();
$mainManager = new MainManager();
$visitorManager = new MainManager();
$userManager = new MainManager();
$editorManager = new MainManager();
$administratorManager = new MainManager();

echo ('$imageManager');echo "<br>";
$reflexion = new ReflectionClass($imageManager);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$mainManager');echo "<br>";
$reflexion = new ReflectionClass($mainManager);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$visitorManager');echo "<br>";
$reflexion = new ReflectionClass($visitorManager);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$userManager');echo "<br>";
$reflexion = new ReflectionClass($userManager);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$editorManager'); echo "<br>";
$reflexion = new ReflectionClass($editorManager);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";
echo ('$administratorManager'); echo "<br>";
$reflexion = new ReflectionClass($administratorManager);
$methodes = $reflexion->getMethods();
foreach ($methodes as $methode) {
    echo $methode->getName() . "<br>";
};
echo "<br>";
echo "<br>";

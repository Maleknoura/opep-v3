<?php
include "plante.php";
$plantObject = new plante($plantId,$plantName,$plantDesc,$plantImage,$plantPrice,$categoryId);
if (isset($_POST['submit'])) {


    $plantName = $_POST["plantName"];
    $plantDesc = $_POST["plantDesc"];
    $plantImage = $_POST["plantImage"];
    $plantPrice = $_POST["plantPrice"];
    $categoryId = $_POST["categoryId"];

    $plantObject->setDesc($plantDesc);
    $plantObject->setImg($plantImage);
    $plantObject->setnom($plantName);
    $plantObject->setPrice($plantPrice);
    $plantObject->setcategoryId($categoryId);

    $plantObject->addplant();
}

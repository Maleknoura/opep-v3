<?php
include "categories.php";
if (isset($_GET['submit'])) {


    $newcategoryId = $_GET["categoryId"];
    $newCategoryName = $_GET["categoryName"];
    $categoryObject = new categories($categoryId, $newCategoryName);

    var_dump($newCategoryName, $newcategoryId);
    $categoryObject->setcategoryId($newcategoryId);
    $categoryObject->setcategoryName($newCategoryName);

    $categoryObject->update();
}

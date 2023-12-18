<?php
include "categories.php";
$categoryObject = new categories($plantId, $plantName, $plantDesc, $plantImage, $plantPrice, $categoryId);
if (isset($_POST['submit'])){
   

    $categoryName = $_POST["categoryName"];
   
   

$categoryObject->setcategoryName($categoryName);

    
    $categoryObject->addcategory();
    header("Location: dashboard-cat.php"); 
}

?>


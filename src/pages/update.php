<?php
include "categories.php";

if (isset($_POST['submit'])) {
    $categoryId = $_POST["categoryId"]; // Assurez-vous que le formulaire a un champ categoryId
    $newCategoryName = $_POST["categoryName"];

    $categoryObject = new categories($categoryId, ''); // Vous n'avez besoin que de l'ID pour la mise à jour

    $categoryObject->update($categoryId, $newCategoryName);
}
?>
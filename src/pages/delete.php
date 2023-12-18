<?php
include "plante.php";

$plante = new plante(0, '', '', '', 0, 0); 

if (isset($_GET['plantId'])) {
    $plantId = $_GET['plantId'];
    

    if ($plante->deletePlant($plantId)) {
        header("Location: dashboard.php"); 
        exit();
    }
    } 

        
 else {
    echo "id non valid";
}
?>
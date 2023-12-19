<?php
include "plante.php";
if (isset($_POST['submit'])) {
    $plantName = $_POST["plantName"];
    $plantDesc = $_POST["plantDesc"];
    $plantPrice = $_POST["plantPrice"];
    $categoryId = $_POST["categoryId"];


$plantObject = new plante($plantId,$plantName,$plantDesc,$plantImage,$plantPrice,$categoryId);

    $image = $_FILES['plantImage']['name'];  
       $tempname = $_FILES['plantImage']['tmp_name'];  
           $folder = "..\images\Plants".$plantImage;        
         if(move_uploaded_file($tempname,$folder)){       
    //    *   // echo 'images est uplade';     }
       }


   

    $plantObject->setDesc($plantDesc);
    $plantObject->setImg($image);
    $plantObject->setnom($plantName);
    $plantObject->setPrice($plantPrice);
    $plantObject->setcategoryId($categoryId);
 
    $plantObject->addplant();

}

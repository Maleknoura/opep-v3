<?php
include_once "plante.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
</head>

<body>
    <?php include("../includes/nav.php") ?>

    <h1 class="text-center mt-10 text-gray-300 text-4xl"> Our Plants</h1>

    <div class="flex justify-center mt-4">
        <?php

        $categories = plante::getAllCategories();
   
        foreach ($categories as $category) {
            echo '<a class="mr-4" href="?category=' . $category['categoryId'] . '">' . $category['categoryName'] . '</a>';
        }
        ?>
        <a href="?category=all">ALL</a> 
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full md:w-4/5 mx-auto mt-6">
        <?php
        // Gérer le filtre par catégorie
        if (isset($_GET['category']) && $_GET['category'] !== 'all') {
            $categoryId = $_GET['category'];
             $plants = plante::getAllCategoriesId($categoryId);
             

        }
        else {
         
             $plants = plante::getAllPlants();
            
        }

        foreach ($plants as $row) {
         
            
        ?>
            <div class="max-w-xs rounded overflow-hidden shadow-lg transition-transform transform hover:scale-105 duration-300 ease-in-out mb-8">
                <img class="w-full h-40 object-cover" src="../images/Plants/<?=$row->getplantimage()?>" alt="Plant Image">
                <div class="px-4 py-2">
                    <div class="font-bold text-md mb-1"><?php echo $row->getplantName() ?></div>
                    <p class="text-gray-700 text-sm"></p>
                </div>
                <div class="px-4 pt-2 pb-1">
                    <p class="text-gray-700 text-sm font-bold"><?php echo $row->getplantPrice() ?>DH</p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <?php include("../includes/footer.html") ?>
</body>

</html>

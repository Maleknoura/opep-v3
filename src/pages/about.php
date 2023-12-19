<?php

include "categories.php";
// session_start();

// if (!isset($_SESSION['client_name'])) {
//     echo "You don't have permission";
//     exit;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
    <title>Dashboard</title>
</head>

<body>

    <?php include("../includes/nav.php") ?>
 <div class="container mt-4">


</div>

    <h1 class="text-center mt-10 text-gray-300 text-4xl"> Our Categories</h1>
    <div class="flex items-center mr-auto">
    <div class="flex items-center mr-auto">
    <input type="text" placeholder="Search..." class="border p-2 mr-2">
    <button class="bg-gray-500 text-white p-2">Search</button>
</div>
</div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full md:w-4/5 mx-auto mt-6">
        <?php
        $a = categories::getAllcategories();
        foreach ($a as $row) {
        ?>
            <div class="max-w-xs rounded overflow-hidden shadow-lg transition-transform transform hover:scale-105 duration-300 ease-in-out mb-8">
                        <div class="px-4 py-2">
                    <div class="font-bold text-md mb-1"><?php echo $row->getcategoryId() ?></div>
                    <p class="text-gray-700 text-sm"></p>
                </div>
                
            </div>
        <?php
        }
        ?>
    </div>
    <?php include("../includes/footer.html") ?>

    <script src="../js/burger.js"></script>
    <script src="../js/cart.js"></script>
    <script src="../js/cartmenu.js"></script>
</body>

</html>
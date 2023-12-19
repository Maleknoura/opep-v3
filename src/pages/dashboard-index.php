<?php

include "plante.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
</head>


<body x-data="{ isOpen: false }">
    <button @click="isOpen = true" class="p-2 pb-1 bg-green-700 mb-2 rounded-md">Add Plant +</button>

    <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 overflow-y-auto px-4 py-6 top-0 left-0 flex items-center justify-center z-50">
        <div class="relative bg-white p-6 rounded-md shadow-xl max-w-md w-full">
            <!-- Contenu du formulaire d'ajout de plante -->
            <form action="addplante.php" method="post">
                <label for="plantName">Plant Name:</label>
                <input type="text" name="plantName" required class="block w-full mt-2 border-gray-300 rounded-md">

                <label for="plantDesc" class="mt-4">Plant Description:</label>
                <textarea name="plantDesc" required class="block w-full mt-2 border-gray-300 rounded-md"></textarea>

                <label for="plantImage" class="mt-4">Plant Image </label>
                <input type="file" name="plantImage" required class="block w-full mt-2 border-gray-300 rounded-md">

                <label for="plantPrice" class="mt-4">Plant Price:</label>
                <input type="number" name="plantPrice" required class="block w-full mt-2 border-gray-300 rounded-md">

                <label for="categoryId" class="mt-4">Category ID:</label>
                <input type="number" name="categoryId" required class="block w-full mt-2 border-gray-300 rounded-md">

                <div class="mt-6">
                    <button type="submit"name ="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Add Plant</button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex flex-col justify-end items-start h-[100vh]">
        <div class="flex pl-8">
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl"></p>
        </div>
        <div class="border-2 border-gray-300 rounded-xl h-[90vh] w-full flex">
            <div class="flex flex-col justify-between w-full p-4">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                         
                                            <th scope="col" class="px-8 py-4 w-1/6">ID</th>
                                            <!-- <th scope="col" class="px-8 py-4 w-1/6">Image</th> -->
                                            <th scope="col" class="px-16 py-4 w-2/6">Name</th>
                                            <!-- <th scope="col" class="px-16 py-4 w-2/6">Description</th> -->
                                            <th scope="col" class="px-8 py-4 w-2/6">Price</th>
                                            <th scope="col" class="px-8 py-4 w-2/6">Category</th>
                                            <th scope="col" class="px-8 py-4 w-2/6">Actions</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    // $a = array();
                                    $a = plante::getAllPlants();


                                        foreach ($a as $row){

                                     
                                        
                                        ?>
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-8 py-4 font-medium"><?php echo $row->getplantId() ?></td>
                                               
                                                <td class="whitespace-nowrap px-16 py-4"><?php echo $row->getplantName() ?></td> 
                                               
                                                <td class="whitespace-nowrap px-8 py-4"><?php echo $row->getplantPrice() ?></td>
                                                <td class="whitespace-nowrap px-8 py-4"><?php echo $row->getcategoryId ()?></td>
                                                <td class="whitespace-nowrap px-8 py-4">
                                             <a href="delete.php?plantId=<?php echo $row->getplantId() ?>"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette plante?')"
                                                        class="text-red-500 hover:text-red-700">Delete</a>
                                                    </td>
                                                
                                          
                                                </tr>
                                                <?php
                                        }
                                       ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include "categories.php";




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html") ?>
</head>

<body x-data="{ isOpen: false }">
    <button @click="isOpen = true" class="p-2 pb-1 bg-green-700 mb-2 rounded-md">Add category +</button>

    <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 overflow-y-auto px-4 py-6 top-0 left-0 flex items-center justify-center z-50">
        <div class="relative bg-white p-6 rounded-md shadow-xl max-w-md w-full">

            <form action="addcategory.php" method="post">
                <label for="categoryName">categoryName:</label>
                <input type="text" name="categoryName" required class="block w-full mt-2 border-gray-300 rounded-md">

                <div class="mt-6">
                    <button type="submit" name="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Add category</button>
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



                                            <th scope="col" class="px-16 py-4 w-2/6">Name of category</th>
                                            <th scope="col" class="px-8 py-4 w-2/6">number of plants</th>
                                            <th scope="col" class="px-8 py-4 w-2/6">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $a = categories::getAllcategories();



                                        foreach ($a as $row) {



                                        ?>
                                            <tr class="border-b dark:border-neutral-500">


                                                <td class="NomCat whitespace-nowrap px-16 py-4"><?php echo $row->getcategoryId() ?> </td>
                                                <td class="IdCat whitespace-nowrap px-16 py-4"><?php echo $row->getcategoryName() ?></td>

                                                <td>

                                                    <button name="Submit" id="btn-UpdateId" <?php echo $row->getcategoryName(); ?> class="p-2 pb-1 bg-gray-500 mb-2 rounded-md">Update </button>



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
    <div id="popCat" onclick="isOpen()" class="absolute hidden inset-0 overflow-y-auto px-4 py-6 top-0 left-0 flex items-center justify-center z-50">
        <div class="relative bg-white p-6 rounded-md shadow-xl max-w-md w-full">

            <form action="update.php" method="GET">

                <label for="categoryName">categoryName:</label>
                <input id="inputname" type="text" name="categoryName" required class="block w-full mt-2 border-gray-300 rounded-md">

                <div class="mt-6">
                    <input id="inputId" type="hidden" name="categoryId" value="">
                    <button type="submit" name="submit" class="bg-gray-500 text-white px-4 py-2 rounded-md" value="">update </button>
                </div>
            </form>
        </div>
    </div>



    <script>
        const popCat = document.querySelector("#popCat");
        const inputname = document.querySelector("#inputname");
        const inputId = document.querySelector("#inputId");
        const btnUpdateId = document.querySelectorAll("#btn-UpdateId")


        btnUpdateId.forEach(btn => {
            btn.addEventListener("click", function() {
                popCat.classList.remove("hidden");

                const tr = this.closest("tr");
                inputId.value = tr.querySelector(".IdCat").textContent.trim();
                inputname.value = tr.querySelector(".NomCat").textContent.trim();
            })
        })
    </script>


</body>
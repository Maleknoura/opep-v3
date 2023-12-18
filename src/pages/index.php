<?php require_once('dash.php'); ?>


<?php
  $Dashboard = new dash();
  $Response = [];
  $Categories = $Dashboard->fetchCategories();
  $selectedCategory=isset($_GET['category'])? $_GET['category']:null;
  $plants=[];
  if($selectedCategory){

    $plantsResponse=$Dashboard->fetchPlants($selectedCategory);
    if($plantsResponse['status']){

        $plants=$plantsResponse['data'];
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
  <?php if ($selectedCategory && !empty($plants)) : ?>
        <div class="mt-10">
            <h3 class="font-serif text-3xl mx-auto text-center mb-5">Plants in <?php echo ucwords($selectedCategory); ?>
            </h3>

            <div class="container mx-auto mt-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <?php foreach ($plants as $plant) : 
                        ?>

                    <div
                        class="swiper-slide w-72 bg-white shadow-md rounded-md duration-500 hover:scale-105 hover:shadow-xl">
                        <img src="<?php echo $plant['image_url']; ?>" alt="Product"
                            class="h-80 w-72 object-cover rounded-t-xl" />
                        <div class="px-4 py-3 w-72">
                            <span class="text-gray-400 mr-3 uppercase text-xs">Nursery</span>
                            <p class="text-lg font-bold text-black truncate block capitalize">
                                <?php echo $plant['name']; ?>
                            </p>
                            <div class="flex items-center">
                                <p class="text-lg font-semibold text-black cursor-auto my-3">
                                    $<?php echo $plant['price']; ?>
                                </p>
                                <del>
                                    <p class="text-sm text-gray-600 cursor-auto ml-2">
                                        $<?php echo $plant['discounted_price']; ?>
                                    </p>
                                </del>
                                <div class="ml-auto">
                                    <form action="" method="POST">
                                        <button type="submit" name="basket" value="<?php echo $plant['id']; ?>">
                                            <input type="number" hidden name="quantity" value="1" min="1">

                                            <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor"
                                                class="bi bi-bag-plus hover:text-green-500 duration-200"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                                <path
                                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                            </svg>

                                        </button>



                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php else : ?>
        <p>No plants found for the selected category.</p>
        <?php endif; ?>
  </body>
  </html>
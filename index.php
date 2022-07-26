<?php ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAGE CREATOR</title>

  <!-- dedault css -->
  <link rel="stylesheet" href="/image-creator/src/vendor/tailwind/tailwind.css">

  <!-- each css -->
</head>

<body>

  <main class="bg-gray-100 rounded-2xl h-screen overflow-hidden relative">
    <div class="flex items-start justify-between">
      <div class="h-screen hidden lg:block my-4 ml-4 shadow-lg relative w-80">

        <!-- sidebar -->
        <?php include(dirname(__FILE__, 1) . "/php/view/partial/sidebar.php"); ?>

      </div>
      <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">

        <!-- header -->
        <?php include(dirname(__FILE__, 1) . "/php/view/partial/header.php"); ?>

        <div class="overflow-auto h-screen pb-24 pt-2 pr-2 pl-2 md:pt-0 md:pr-0 md:pl-0">
          <div class="flex flex-row flex-wrap">

            <!-- left side -->
            <div class="w-1/2 pr-4">
              <div class="mb-4 mx-0">
                <div class="shadow-lg rounded-2xl bg-white p-4 hover:opacity-75 transition ease-in duration-200 mb-4">
                  <a href="/image-creator/market/" class="flex-row gap-4 flex justify-center items-center">
                    <div class="flex-shrink-0 w-2/12">
                      <span class="block relative">
                        <img alt="" src="/image-creator/market/image/icon/market.svg" class="mx-auto object-fit h-24 w-24 " />
                      </span>
                    </div>
                    <div class="flex flex-col w-8/12">
                      <span class="text-gray-600 text-lg font-medium">
                        マーケットコラム興味津々 - 注目予定
                      </span>
                      <span class="text-gray-400 text-xs">https://www3.nhk.or.jp/news/special/stockmarket/</span>
                    </div>
                    <div class="flex-shrink-0 w-2/12">
                      <span class="block relative">
                        <img alt="" src="/image-creator/common/images/icon/arrow.svg" class="mx-auto object-fit h-8 w-8 " />
                      </span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>

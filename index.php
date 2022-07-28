<?php
require_once(__DIR__ . '/php/model/function/pageData.php');

$pageData = new pageData();
$pageDir = $pageData->getPageDir($_SERVER["PHP_SELF"]);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMAGE CREATOR</title>

  <!-- dedault css -->
  <link rel="stylesheet" href="/image-creator/common/vendor/tailwind/tailwind.css">

  <!-- each css -->
</head>

<body>
  <main class="bg-gray-100 rounded-2xl h-screen relative">
    <div class="flex">
      <div class="h-screen my-4 ml-4 shadow-lg relative" style="width: 320px;">
        <!-- sidebar -->
        <?php include(dirname(__FILE__, 1) . "/php/view/partial/sidebar.php"); ?>
      </div>

      <div class="flex flex-col pl-0 my-4 ml-4" style="width: 1280px;">
        <div class="h-screen pb-24">
          <div class="flex flex-row flex-wrap justify-around">

            <!-- マーケットコラム -->
            <div style="width: 620px;">
              <div class="mb-4 mx-0">
                <div class="shadow-lg rounded-2xl bg-white p-4 hover:opacity-75 transition ease-in duration-200 mb-4">
                  <a href="/image-creator/market/" class="flex-row gap-2 flex justify-center items-center">
                    <div class="flex-shrink-0 w-2/12">
                      <span class="block relative">
                        <img alt="" src="/image-creator/market/image/icon/market.svg" class="mx-auto object-contain h-16 w-16 " />
                      </span>
                    </div>
                    <div class="flex flex-col w-8/12">
                      <span class="text-gray-600 text-lg font-medium">マーケットコラム興味津々 - 注目予定</span>
                    </div>
                    <div class="flex-shrink-0 w-2/12">
                      <span class="block relative">
                        <img alt="" src="/image-creator/common/images/icon/arrow.svg" class="mx-auto object-contain h-4 w-4 " />
                      </span>
                    </div>
                  </a>
                </div>
              </div>
            </div>

            <!-- 未定 -->
            <div style="width: 620px;">
              <div class="mb-4 mx-0">
                <div class="shadow-lg rounded-2xl bg-white p-4 hover:opacity-75 transition ease-in duration-200 mb-4">
                  <a href="" class="flex-row gap-2 flex justify-center items-center">
                    <div class="flex-shrink-0 w-2/12">
                      <span class="block relative">
                        <img alt="" src="/image-creator/common/images/icon/nodecide.svg" class="mx-auto object-contain h-16 w-16 " />
                      </span>
                    </div>
                    <div class="flex flex-col w-8/12">
                      <span class="text-gray-600 text-lg font-medium">未定</span>
                    </div>
                    <div class="flex-shrink-0 w-2/12">
                      <span class="block relative">
                        <img alt="" src="/image-creator/common/images/icon/arrow.svg" class="mx-auto object-contain h-4 w-4 " />
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

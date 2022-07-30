<?php
require_once(__DIR__ . '/../php/model/function/pageData.php');
require_once(__DIR__ . '/../php/model/function/jsonData.php');

$pageData = new pageData();
$jsonData = new JsonData();
$pageDir = $pageData->getPageDir($_SERVER["PHP_SELF"]);
$path = $jsonData->getJsonDataPath($pageDir);
$targetJsonData = $jsonData->getJsonData($path);

?>

<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マーケット興味津々 - 注目予定</title>
  <link rel="stylesheet" href="/image-creator/market/css/index.css">
  <link rel="stylesheet" href="/image-creator/market/css/flags.css">
  <link rel="stylesheet" href="/image-creator/common/vendor/tailwind/tailwind.css">
</head>

<body>
  <main class="bg-gray-100 rounded-2xl relative w-min pr-4">
    <div class="flex">
      <div class="my-4 ml-4 shadow-lg relative" style="width: 320px;">
        <!-- sidebar -->
        <?php include(dirname(__FILE__, 2) . "/php/view/partial/sidebar.php"); ?>
      </div>

      <div class="flex flex-col pl-0 my-4 ml-4">
        <div class="pb-24">

          <h1 class="text-4xl font-semibold text-gray-800 mt-8">マーケット興味津々 - 注目予定</h1>
          <h2 class="text-md text-gray-400 mt-4"><a href="https://www3.nhk.or.jp/news/special/stockmarket/" target="_blank">https://www3.nhk.or.jp/news/special/stockmarket/</a></h2>

          <div class="flex flex-row flex-nowrap mt-8 pb-16">

            <div class="mr-8">
              <div class="shadow-lg px-4 py-6 w-full bg-white relative">

                <!-- データ操作エリア -->
                <?php include(dirname(__FILE__) . "/php/view/partial/list.php"); ?>

              </div>
            </div>

            <!-- テーブル部分 -->
            <?php include(dirname(__FILE__) . "/php/view/partial/imageTable.php"); ?>

          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>

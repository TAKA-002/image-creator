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

            <!-- データ操作エリア -->
            <div class="mr-8">
              <div class="shadow-lg px-4 py-6 w-full bg-white relative">

                <?php include(dirname(__FILE__) . "/php/view/partial/list.php"); ?>

              </div>
            </div>

            <!-- テーブル部分 -->
            <div class="w-max">
              <div class="shadow-lg px-4 py-6 w-full bg-white relative">
                <div id="capture" class="list">
                  <div class="list__header">
                    <h3 class="list__header-text">注目予定<span>(いずれも日本時間)</span></h3>
                  </div>
                  <div class="list__body">
                    <!-- jsで自動出力 -->
                    <ul id="js-list" class="list__body-wrap">
                      <li class="list__body-date"><time>7月25日(月)</time>
                        <ul class="plans">
                          <li class="icon-GER">Ifo景況感指数(7月)</li>
                        </ul>
                      </li>
                      <li class="list__body-date"><time>7月26日(火)</time>
                        <ul class="plans">
                          <li class="icon-JP">日銀 金融政策決定会合 議事要旨(6/16〜17)</li>
                          <li class="icon-"> 2Q決算)キヤノン</li>
                          <li class="icon-US">新築住宅販売件数(6月)</li>
                        </ul>
                      </li>
                      <li class="list__body-date"><time>7月27日(水)</time>
                        <ul class="plans">
                          <li class="icon-JP">1Q決算)JR東海 東京ガス 信越化学工業</li>
                          <li class="icon-US">耐久財受注(6月・速報値)</li>
                          <li class="icon-">本決算)マイクロソフト</li>
                          <li class="icon-">2Q決算)アルファベット(傘下にグーグル)</li>
                        </ul>
                      </li>
                      <li class="list__body-date"><time>7月28日(木)</time>
                        <ul class="plans">
                          <li class="icon-JP">1Q決算)オリエンタルランド</li>
                          <li class="icon-US">FOMC FRBパウエル議長会見</li>
                          <li class="icon-">実質GDP(4～6月)</li>
                          <li class="icon-">2Q決算)メタ(旧フェイスブック)</li>
                        </ul>
                      </li>
                      <li class="list__body-date"><time>7月29日(金)</time>
                        <ul class="plans">
                          <li class="icon-JP">日銀 金融政策決定会合 主な意見(7/20〜21)</li>
                          <li class="icon-">1Q決算)味の素 ソニーG みずほFG JR東日本</li>
                          <li class="icon-EU">実質GDP(4～6月)</li>
                          <li class="icon-">消費者物価指数(7月)</li>
                          <li class="icon-US">ミシガン大学消費者態度指数(7月・確報値)</li>
                          <li class="icon-">3Q決算)アップル</li>
                          <li class="icon-">2Q決算)アマゾン・ドット・コム</li>
                        </ul>
                      </li>
                    </ul>
                  </div>
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

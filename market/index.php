<?php

/**
 * < プラン >
 * data.jsonからデータは取得して、それをテーブルに表示。その表示されたデータが編集されたらdata.jsonの内容を更新していく。
 * 理想はその場編集。
 * 最後に、編集が終わったら、data.jsonを元に、画像データを表示するためのimageTableData.jsonファイルを生成するようにする。
 * imageTableData.jsonファイルを読み込むことで、画像の部分を表示するようにする。
 * あとは、html2canvasライブラリで、ダウンロードできるようにする。
 *
 * < 追加機能 メモ >
 * ・国旗追加機能
 * 指定サイズの国旗の画像を追加し、割り当てるクラス名を指定したら追加できるようにする。
 * flag.cssファイルを更新するようにするということ。
 * images/flagsの中に画像もリネームして格納できるようにする。
 *
 * ・スーパーリロードボタン
 * 意外とかんたんっぽい。
 */

// グローバル
require_once(__DIR__ . '/../php/model/function/pageData.php');
require_once(__DIR__ . '/../php/model/function/jsonData.php');

// market内
require_once(__DIR__ . '/php/model/function/data.php');

$pageData = new pageData();
$jsonData = new JsonData();
$dataObj = new Data();

// DISPFLAG
const LIST_FLAG = "list";
const CREATE_FLAG = "create";
const EDIT_FLAG = "edit";
const ADD_NATIONALFLAG_FLAG = "nationalflag";

// DATAFLAG
const EDITED_DATA_FLAG = "2";


// $pageDir - sidebarでアクティブのページのときのcssに切り替えるために使用。
$pageDir = $pageData->getPageDir($_SERVER["PHP_SELF"]);

// $path - jsonファイルを取得する
$path = $jsonData->getJsonDataPath($pageDir);

// 編集用テーブルに表示させたいjsonデータを取得
$targetJsonData = $jsonData->getJsonData($path);

// 新規追加
if ($_POST["dispFlag"] === CREATE_FLAG) {
  // IDを作成(IDの条件は他に存在しないIDであることなので、まずは現在のデータのIDを取得)
  $createdId = $dataObj->createId($targetJsonData);

  // 今ある国旗のリストを作成
  $flagsList = $dataObj->getFlagJsonData();
}

// 編集の場合
if ($_POST["dispFlag"] === EDIT_FLAG && $_POST["opeDataFlag"] !== EDITED_DATA_FLAG) {
  $targetEditData["id"] = $_POST["id"];
  $targetEditData["day"] = $_POST["day"];
  $targetEditData["plan"] = $_POST["plan"];
  $targetEditData["nationalFlag"] = $_POST["nationalFlag"];
  $targetEditData["paintParts"] = $_POST["paintParts"];
  $targetEditData["colorCode"] = $_POST["colorCode"];
}

// 編集画面からデータ取得した場合
if ($_POST["opeDataFlag"] === EDITED_DATA_FLAG) {
  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
}


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
        <!-- サイドバー => use $pageDir -->
        <?php include(dirname(__FILE__, 2) . "/php/view/partial/sidebar.php"); ?>
      </div>

      <div class="flex flex-col pl-0 my-4 ml-8">
        <div class="pb-24">

          <h1 class="text-4xl font-semibold text-gray-800 mt-8">マーケット興味津々 - 注目予定</h1>
          <h2 class="text-md text-gray-400 mt-4"><a href="https://www3.nhk.or.jp/news/special/stockmarket/" target="_blank">https://www3.nhk.or.jp/news/special/stockmarket/</a></h2>

          <div class="flex flex-row flex-nowrap mt-8 pb-16 w-screen">
            <div class="flex flex-row flex-nowrap mt-8 pb-16 w-max">

              <!-- データ操作テーブルエリア => use $targetJsonData -->
              <?php if ($_POST["dispFlag"] === LIST_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/partial/list.php"); ?>

                <!-- 新規作成画面と差し替える -->
              <?php elseif ($_POST["dispFlag"] === CREATE_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/actions/create.php"); ?>

                <!-- 編集画面と差し替える -->
              <?php elseif ($_POST["dispFlag"] === EDIT_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/actions/edit.php"); ?>

                <!-- 国旗追加画面と差し替える -->
              <?php elseif ($_POST["dispFlag"] === ADD_NATIONALFLAG_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/actions/addNationalFlag.php"); ?>

                <!-- それ以外はエラーページへ -->
              <?php else : ?>
                <?php include(dirname(__FILE__) . "/php/view/partial/error.php"); ?>
              <?php endif; ?>

              <!-- 画像になる部分 -->
              <?php include(dirname(__FILE__) . "/php/view/partial/imageTable.php"); ?>

            </div>
          </div>
        </div>
      </div>
  </main>
</body>

</html>

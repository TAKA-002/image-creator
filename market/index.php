<?php
session_start();

/**
 * < プラン >
 * data.jsonからデータは取得して、それをテーブルに表示。その表示されたデータが編集されたらdata.jsonの内容を更新していく。
 * 最後に、編集が終わったら、data.jsonを元に、画像データを表示するためのimageTableData.jsonファイルを生成するようにする。
 * imageTableData.jsonファイルを読み込むことで、画像の部分を表示するようにする。
 * あとは、html2canvasライブラリで、ダウンロードできるようにする。
 *
 * ・スーパーリロードボタン
 * 意外とかんたんっぽい。
 */

// グローバル
require_once(__DIR__ . '/../php/model/function/pageData.php');
require_once(__DIR__ . '/../php/model/function/jsonData.php');

// market内
require_once(__DIR__ . '/php/model/function/data.php');
require_once(__DIR__ . '/php/model/function/flagFile.php');

$pageData = new pageData();
$jsonData = new JsonData();
$dataObj = new Data();
$flagfileObj = new FlagFile();

// DISPFLAG
const LIST_FLAG = "list";
const CREATE_FLAG = "create";
const EDIT_FLAG = "edit";
const ADD_NATIONALFLAG_FLAG = "nationalflag";

// DATAFLAG
const DATA_NONE_FLAG = "nodata";
const DATA_CREATE_FLAG = "created";
const DATA_EDIT_FLAG = "edited";
const DATA_DELETE_FLAG = "deleted";
const DATA_ALL_DELETE_FLAG = "allDelete";
const DATA_MOVE_UP_FLAG = "up";
const DATA_MOVE_DOWN_FLAG = "down";

// $pageDir - sidebarでアクティブのページのときのcssに切り替えるために使用。
$pageDir = $pageData->getPageDir($_SERVER["PHP_SELF"]);

// $path - jsonファイルを取得する
$path = $jsonData->getJsonDataPath($pageDir);

// 編集用テーブルに表示させたいjsonデータを取得
$targetJsonData = $jsonData->getJsonData($path);

// 今ある国旗のリストを作成し、表示するため
$flagsList = $flagfileObj->getFlagJsonData();

// /////////////////////////////////////////////////////////////////////////

/**
 * 「新規追加」ボタンを押した場合
 */
if ($_POST["dispFlag"] === CREATE_FLAG && $_POST["opeDataFlag"] === DATA_NONE_FLAG) {
  // IDを作成
  $createdId = $dataObj->createId($targetJsonData);
}

/**
 * 新規作成：新規データがPOSTで送られてきた場合
 */
if ($_POST["dispFlag"] === LIST_FLAG && $_POST["opeDataFlag"] === DATA_CREATE_FLAG) {

  if ((isset($_REQUEST["chkno"]) == true) && (isset($_SESSION["chkno"]) == true) && ($_REQUEST["chkno"] == $_SESSION["chkno"])) {

    // 新規データを現在のJsonデータに追加。（最後尾）
    $mergedData = $dataObj->addNewData($_POST, $targetJsonData);

    // マージされたデータをjsonファイルにする
    $jsonData->updateJsonData($path, $mergedData);

    // jsonデータを再読み込み
    $targetJsonData = $jsonData->getJsonData($path);
  }
}

// /////////////////////////////////////////////////////////////////////////

/**
 * 削除：削除データがPOSTされてきた場合
 */
if ($_POST["dispFlag"] === LIST_FLAG && $_POST["opeDataFlag"] === DATA_DELETE_FLAG) {
  if ((isset($_REQUEST["chkno"]) == true) && (isset($_SESSION["chkno"]) == true) && ($_REQUEST["chkno"] == $_SESSION["chkno"])) {
    // データを削除する
    $deletedData = $dataObj->deleteData($_POST["id"], $targetJsonData);

    // マージされたデータをjsonファイルにする
    $jsonData->updateJsonData($path, $deletedData);

    // jsonデータを再読み込み
    $targetJsonData = $jsonData->getJsonData($path);
  }
}

/**
 * 全消し：全データ削除
 */
if ($_POST["dispFlag"] === LIST_FLAG && $_POST["opeDataFlag"] === DATA_ALL_DELETE_FLAG) {
  if ((isset($_REQUEST["chkno"]) == true) && (isset($_SESSION["chkno"]) == true) && ($_REQUEST["chkno"] == $_SESSION["chkno"])) {
    $deleteData = [];
    $jsonData->updateJsonData($path, $deleteData);
  }
}

// /////////////////////////////////////////////////////////////////////////

/**
 * 編集
 */
if ($_POST["dispFlag"] === EDIT_FLAG && $_POST["opeDataFlag"] === DATA_NONE_FLAG) {
  $targetEditData["id"] = $_POST["id"];
  $targetEditData["date"] = $_POST["date"];
  $targetEditData["plan"] = $_POST["plan"];
  $targetEditData["nationalFlag"] = $_POST["nationalFlag"];
  $targetEditData["paintParts"] = $_POST["paintParts"];
  $targetEditData["colorCode"] = $_POST["colorCode"];
}

// 編集：編集画面からデータを取得した場合
if ($_POST["dispFlag"] === LIST_FLAG && $_POST["opeDataFlag"] === DATA_EDIT_FLAG) {
  if ((isset($_REQUEST["chkno"]) == true) && (isset($_SESSION["chkno"]) == true) && ($_REQUEST["chkno"] == $_SESSION["chkno"])) {
    $replacedData = $dataObj->replaceData($_POST, $targetJsonData);

    // 置きかえたデータをjsonファイルにする
    $jsonData->updateJsonData($path, $replacedData);

    // jsonデータを再読み込み
    $targetJsonData = $jsonData->getJsonData($path);
  }
}

// 移動
if ($_POST["dispFlag"] === LIST_FLAG && $_POST["opeDataFlag"] === DATA_MOVE_UP_FLAG || $_POST["dispFlag"] === LIST_FLAG && $_POST["opeDataFlag"] === DATA_MOVE_DOWN_FLAG) {

  $result = $dataObj->moveData($_POST["key"], $_POST["opeDataFlag"], $targetJsonData);

  $jsonData->updateJsonData($path, $result);

  // 更新したデータをもう一度読み込む
  $targetJsonData = $jsonData->getJsonData($path);

  $_POST = array();
  $_POST["dispFlag"] = LIST_FLAG;
  $_POST["opeDataFlag"] = DATA_NONE_FLAG;
}

$_SESSION["chkno"] = $chkno = mt_rand();
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

  <!-- vendor -->
  <script src="/image-creator/common/vendor/jquery/jquery-3.6.0.min.js"></script>
  <script src="/image-creator/common/vendor/html2capture/html2capture.js"></script>

  <!-- local -->
  <script src="./js/yotei/list.js"></script>
  <script src="./js/index.js"></script>
</head>

<body>
  <main class="bg-gray-100 rounded-2xl relative w-min pr-4 h-full">
    <div class="flex">
      <div class="my-4 ml-4 shadow-lg relative h-screen" style="width: 320px;">
        <?php include(dirname(__FILE__, 2) . "/php/view/partial/sidebar.php"); ?>
      </div>

      <div class="flex flex-col pl-0 my-4 ml-8">
        <div class="pb-24">

          <h1 class="text-4xl font-semibold text-gray-800 mt-8">マーケット興味津々 - 注目予定</h1>
          <h2 class="text-md text-gray-400 mt-4"><a href="https://www3.nhk.or.jp/news/special/stockmarket/" target="_blank">https://www3.nhk.or.jp/news/special/stockmarket/</a></h2>

          <div class="flex flex-row flex-nowrap mt-8 pb-16 w-screen">
            <div class="flex flex-row flex-nowrap mt-8 pb-16 w-max">

              <?php if ($_POST["dispFlag"] === LIST_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/partial/list.php"); ?>

              <?php elseif ($_POST["dispFlag"] === CREATE_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/actions/create.php"); ?>

              <?php elseif ($_POST["dispFlag"] === EDIT_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/actions/edit.php"); ?>

              <?php elseif ($_POST["dispFlag"] === ADD_NATIONALFLAG_FLAG) : ?>
                <?php include(dirname(__FILE__) . "/php/view/actions/addNationalFlag.php"); ?>

              <?php else : ?>
                <?php include(dirname(__FILE__) . "/php/view/partial/error.php"); ?>
              <?php endif; ?>

              <?php include(dirname(__FILE__) . "/php/view/partial/imageTable.php"); ?>

            </div>
          </div>
        </div>
      </div>
  </main>
</body>

<script src="./js/yotei/html2capture_conf.js"></script>

</html>
<?php

/**
 * 国旗のファイルと、ファイル名（クラス名）を入力
 * 入力された文字列で画像ファイルをmarket/image/flagsの中に追加。
 * cssファイルに追加された画像用のCSSを追加。
 * flags.jsonにブロックを追加。
 */
require_once(__DIR__ . '/../../model/function/data.php');
require_once(__DIR__ . '/../../model/function/flagFile.php');
$dataObj = new Data();
$flagfileObj = new FlagFile();

// 今ある国旗のリストを作成
$flagsList = $flagfileObj->getFlagJsonData();

// $_FILES['uploadFile]['name']のなかで、'.'があった場所から、最後までを返し、
// substrでその１バイト後ろからの文字列を返す
// ドットをとった拡張子が取れる
$extension = substr(strrchr($_FILES['uploadFile']['name'], '.'), 1);

// $_FILESで送られてきたファイルが画像であるか確認するための変数
if ($extension === "jpg") {
  $filetype = "image/jpeg";
} else {
  $filetype = "image/$extension";
}

// エラーテキストを格納する配列
$errorMsgs = [];

////////////////////////////////////////////////////////////////////////////////////

// validation：$_FILESで送られてきたデータが画像ファイルであるかチェック
if ($_FILES["uploadFile"]["type"] !== $filetype) {
  $errorMsgs[] = "■ ファイル：選択したデータが「画像」ではありませんでした。";
}

// validation：国旗名がすでに存在しているか
foreach ($flagsList as $key => $value) {
  if (strtoupper($_POST["nationalFlagName"]) === strtoupper($flagsList[$key]["name"])) {
    $errorMsgs[] = "■ CSSクラス名・画像ファイル名：すでに登録済のものが記載されています。別の文字列にしてください。";
  }
}

// validation：入力した国旗名が英字だけで入力されているか
if (!preg_match('/^[a-zA-Z]+$/', $_POST["nationalFlagName"])) {
  $errorMsgs[] = "■ CSSクラス名・画像ファイル名：半角英字のみで入力してください。";
}

////////////////////////////////////////////////////////////////////////////////////

// validationチェックを通過。
if (count($errorMsgs) === 0) {
  $flagFile = new FlagFile();

  /**
   * 画像を格納
   */

  // 画像保存先ディレクトリ
  $flagImgDir = dirname(__DIR__, 3) . "/image/flags/";

  // 画像ファイルリネーム
  $flagImgName = $flagFile->renameImgFile($_POST["nationalFlagName"], strrchr($_FILES['uploadFile']['name'], '.'));

  // 画像ファイルを格納
  move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $flagImgDir . $flagImgName);

  /**
   * flags.jsonを更新
   */
  $flagfileObj->updateFlagData($_POST, $flagImgName);

  /**
   * CSSファイルにクラスを追加
   */
  $flagFile->updateFlagCss($_POST["nationalFlagName"], $extension);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>国旗追加結果</title>
  <link rel="stylesheet" href="/image-creator/common/vendor/tailwind/tailwind.css">

</head>

<body>
  <div class="w-full">
    <?php if (count($errorMsgs) > 0) : ?>
      <div class="w-9/12 my-10 mx-auto  bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <h2 class="font-bold text-2xl">Error!!<span class="ml-4 text-sm">※必ず下のボタンから戻ってください。(ブラウザバック非推奨) </span></h2>
        <ul class="mt-4">
          <?php foreach ($errorMsgs as $msg) : ?>
            <li class="mt-2"><?php echo $msg ?></li>
          <?php endforeach; ?>
        </ul>

        <form class="mb-0 inline mx-2" action="../../../index.php" method="POST">
          <input type="hidden" name="dispFlag" value="nationalflag">
          <input type="hidden" name="opeDataFlag" value="nodata">

          <button class="border-red-400 bg-red-300 hover:bg-opacity-75 text-red-700 font-semibold mt-4 py-2 px-4 border border-gray-400 rounded shadow" autofocus>
            国旗追加ページへ戻る
          </button>
        </form>

        <form class="mb-0 inline mx-2" action="../../../index.php" method="POST">
          <input type="hidden" name="dispFlag" value="list">
          <input type="hidden" name="opeDataFlag" value="nodata">

          <button class="border-red-400 bg-red-300 hover:bg-opacity-75 text-red-700 font-semibold mt-4 py-2 px-4 border border-gray-400 rounded shadow">
            リストページへ戻る
          </button>
        </form>
      </div>

    <?php else : ?>

      <div class="w-9/12 my-10 mx-auto  bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
        <h2 class="font-bold text-2xl">Success!!<span class="ml-4 text-sm">※必ず下のボタンから戻ってください。(ブラウザバック非推奨) </span></h2>
        <ul class="mt-4">
          <li class="mt-2">国旗のデータ追加に成功しました。使用することが可能です。</li>
        </ul>

        <form class="mb-0 inline mx-2" action="../../../index.php" method="POST">
          <input type="hidden" name="dispFlag" value="nationalflag">
          <input type="hidden" name="opeDataFlag" value="nodata">

          <button class="border-blue-400 bg-blue-300 hover:bg-opacity-75 text-blue-700 font-semibold mt-4 py-2 px-4 border border-gray-400 rounded shadow" autofocus>
            国旗追加ページへ戻る
          </button>
        </form>

        <form class="mb-0 inline mx-2" action="../../../index.php" method="POST">
          <input type="hidden" name="dispFlag" value="list">
          <input type="hidden" name="opeDataFlag" value="nodata">

          <button class="border-blue-400 bg-blue-300 hover:bg-opacity-75 text-blue-700 font-semibold mt-4 py-2 px-4 border border-gray-400 rounded shadow">
            リストページへ戻る
          </button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>
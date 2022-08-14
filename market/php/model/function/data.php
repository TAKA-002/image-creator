<?php

class Data
{

  /**
   * IDをランダム整数で作成し、文字列にして返す
   * すでに存在しているIDの場合は再帰的に実行
   *
   * @param Array $targetJsonData 現在のJsonデータ
   *
   * @return String $strNum ユニークID
   */
  public function createId($targetJsonData)
  {
    $num = mt_rand(1, 100);
    $strNum = (string)$num;

    $ids = $this->extractId($targetJsonData);
    $result = $this->checkId($strNum, $ids);

    if (!$result) {
      return $this->createId($targetJsonData);
    }
    return $strNum;
  }

  /**
   * 新規作成したIDがすでに存在していないかチェック
   *
   * @param String $createdId 新規作成されたID
   *
   * @param Array{
   *  idx => string,
   *  idx => string,
   *  idx => string,
   *  idx => string,
   * } $aryId
   *
   * @return Boolean
   */
  private function checkId($createdId, $aryId)
  {
    foreach ($aryId as $existingId) {
      if ($createdId === $existingId) {
        return false;
      }
    }
    return true;
  }

  /**
   * 現在のJsonデータからIDを抽出して配列にする
   *
   * @param Array $targetJsonData 現在のJsonデータ
   *
   * @return Array{
   *  idx => string,
   *  idx => string,
   *  idx => string,
   *  idx => string,
   * } $ids 抽出した全ID
   */
  private function extractId($targetJsonData)
  {
    $ids = array();
    foreach ($targetJsonData as $item) {
      $ids[] = $item["id"];
    }
    return $ids;
  }


  //////////////////////////////////////////////////////////////////////////////////////

  /**
   * 現在登録されている国旗データを取得する
   *
   * @return
   */
  public function getFlagJsonData()
  {
    $path =  $this->getFlagDataPath();
    $file = file_get_contents($path);
    $json = mb_convert_encoding($file, "UTF8", 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $jsonData = json_decode($json, true);
    return $jsonData;
  }


  /**
   * 現在使われているflag.jsonファイルのパスを取得する
   */
  private function getFlagDataPath()
  {
    return dirname(__DIR__, 3) . "/data/flags.json";
  }

  /**
   * 
   * 入力値を変換してデータを追加
   * 
   * {
   * "name": "US",
   * "display": "アメリカ",
   * "img": "/image-creator/market/image/flags/US.png"
   * },
   */
  public function updateFlagData($post, $flagImgName)
  {
    // 元データ取得
    $flagsListJson = $this->getFlagJsonData();
    $path = $this->getFlagDataPath();

    // 入力値を変換
    $prepared = $this->transformInputData($post, $flagImgName);

    // 元データにinput配列を追加。
    $addedJsonData = array_merge($flagsListJson, $prepared);

    // データをアップデート
    $arrJson = json_encode($addedJsonData);
    file_put_contents($path, $arrJson);
    return;
  }

  /**
   * 入力値を変換
   */
  private function transformInputData($post, $flagImgName)
  {
    $input["name"] = strtoupper($post["nationalFlagName"]);
    $input["display"] = $post["countryName"];
    $input["img"] = "/image-creator/market/image/flags/" . $flagImgName;
    return array($input);
  }

  //////////////////////////////////////////////////////////////////////////////////////

  /**
   * 新規追加データを現状のデータの最後に追加する。
   *
   * @param Array $newData 新規追加データ（フラグ込みのPOST）
   *
   * @param Array $targetJsonData 現在リスト表示されているデータ
   *
   * @return Array マージされたデータ
   */
  public function addNewData($newData, $targetJsonData)
  {
    // 不要フラグ除去
    $newData = $this->removeFlag($newData);
    $new[] = $newData;

    // 現在データに追加
    return array_merge($targetJsonData, $new);
  }

  /**
   * 不要なフラグを除去
   *
   * @param Array $data 対象データ
   *
   * @return Array $newData dispFlagとopeDataFlagを除去したデータ
   */
  private function removeFlag($data)
  {
    unset($data["dispFlag"]);
    unset($data["opeDataFlag"]);

    return $data;
  }

  //////////////////////////////////////////////////////////////////////////////////////

  /**
   * 削除ボタンを押したデータを削除する
   *
   * @param String $deleteItemId
   *
   * @param Array $targetJsonData 現在リスト表示されているデータ
   */
  public function deleteData($deleteItemId, $targetJsonData)
  {

    foreach ($targetJsonData as $key => $value) {

      if ($targetJsonData[$key]["id"] === $deleteItemId) {
        array_splice($targetJsonData, $key, 1);
      }
    }

    return $targetJsonData;
  }

  //////////////////////////////////////////////////////////////////////////////////////

  /**
   * データを置き換える
   */
  public function replaceData($editedData, $targetJsonData)
  {
    $editedData = $this->removeFlag($editedData);

    foreach ($targetJsonData as $key => $value) {
      if ($value["id"] === $editedData["id"]) {
        $preparedData[$key] = $editedData;
        /** @var array $targetJsonData */
        array_splice($targetJsonData, $key, 1, $preparedData);
      }
    }
    return $targetJsonData;
  }


  /**
   * データを入れ替える
   */
  public function moveData($key, $moveFlag, $targetJsonData)
  {
    $listMaxKeyNum = count($targetJsonData) - 1;
    $listMaxKeyStr = (string)$listMaxKeyNum;
    $replacedData = array();

    // $keyが0で、upのときは注意。逆にdownでリストの最後の数字のときも注意。何もしていないjsonを戻す。
    if ($key === "0" && $moveFlag === "up" || $key === $listMaxKeyStr && $moveFlag === "down") {
      return $targetJsonData;
    }

    // 一番上の項目ではなく、上へ移動のflagのとき。
    if ($key !== "0" && $moveFlag === "up") {
      $replacedData[$key - 1] = $targetJsonData[$key];
      $replacedData[$key] = $targetJsonData[$key - 1];
      array_splice($targetJsonData, $key - 1, 2, $replacedData);
      return $targetJsonData;
    }

    // 一番下の項目ではなく、下へ移動のflagのとき。
    if ($key !== $listMaxKeyStr && $moveFlag === "down") {
      $replacedData[$key] = $targetJsonData[$key + 1];
      $replacedData[$key + 1] = $targetJsonData[$key];
      array_splice($targetJsonData, $key, 2, $replacedData);
      return $targetJsonData;
    }
  }
}

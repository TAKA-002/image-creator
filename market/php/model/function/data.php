<?php

class Data
{

  /**
   * IDをランダム整数で作成し、文字列にして返す
   * すでに存在しているIDの場合は再帰的に実行
   * 
   * @param object $targetJsonData 現在のJsonデータ
   * 
   * @return string $strNum ユニークID
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
   * @param string $createdId 新規作成されたID
   * 
   * @param array{
   *  idx => string,
   *  idx => string,
   *  idx => string,
   *  idx => string,
   * } $aryId
   * 
   * @return boolean
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
   * @param object $targetJsonData 現在のJsonデータ
   * 
   * @return array{
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
   * 現在使われているflags.cssファイルのパスを取得する（cssファイルを生成するときに使う）
   */
  private function getCssDataPath()
  {
    return dirname(__DIR__, 3) . "/css/flags.css";
  }
}

<?php

class Data
{

  /**
   * IDをランダム整数で作成し、文字列にして返す
   * すでに存在しているIDの場合は再帰的に実行
   * @param - $targetJsonData 現在のJsonデータ
   * @return - ユニークID
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
   * @param $createdId - 新規作成されたID
   * @param $aryId - 現在あるデータから抽出されたIDたちの配列
   * @return bool
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
   * @param - $targetJsonData 現在のJsonデータ
   * @return - array 現在のデータのIDを抽出した配列
   */
  private function extractId($targetJsonData)
  {
    $ids = array();
    foreach ($targetJsonData as $item) {
      $ids[] = $item["id"];
    }
    return $ids;
  }
}

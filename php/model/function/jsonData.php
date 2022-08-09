<?php

class JsonData
{

  /**
   * jsonパスを取得
   * @param $pageDir - 取得したいjsonファイルの該当ディレクトリ名
   * @return - フルパス
   */
  public function getJsonDataPath($pageDir)
  {
    return dirname(__FILE__, 4) . "/{$pageDir}/data/data.json";
  }

  /**
   * json文字列を取得
   * @param $path - jsonファイルのパス
   * @return $jsonData - decodeされたjson文字列
   */
  public function getJsonData($path)
  {
    $file = file_get_contents($path);
    $json = mb_convert_encoding($file, "UTF8", 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $jsonData = json_decode($json, true);
    return $jsonData;
  }


  /**
   * jsonファイルを更新する
   */
  public function updateJsonData($path, $newData)
  {
    $arrJson = json_encode($newData);
    file_put_contents($path, $arrJson);
    return;
  }
}

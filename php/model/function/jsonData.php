<?php

class JsonData
{
  public function getJsonDataPath($pageDir)
  {
    return dirname(__FILE__, 4) . "/{$pageDir}/data/data.json";
  }

  public function getJsonData($path)
  {
    $file = file_get_contents($path);
    $json = mb_convert_encoding($file, "UTF8", 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $jsonData = json_decode($json, true);
    return $jsonData;
  }
}

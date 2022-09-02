<?php

class FlagFile
{
  /**
   * 現在使われているflags.cssファイルのパスを取得する（cssファイルを生成するときに使う）
   */
  private function getCssDataPath()
  {
    return dirname(__DIR__, 3) . "/css/flags.css";
  }


  private function prepareAddCssClass($class, $extension)
  {
    $temp = <<<EOT
    .icon-{$class}::before {
      background-image: url(/image-creator/market/image/flags/{$class}.{$extension});
      background-repeat: no-repeat;
      background-size: cover;
    }
    EOT;

    return $temp;
  }

  /**
   * flags.cssファイルを更新する
   */
  public function updateFlagCss($className, $extension)
  {
    $cssPath = $this->getCssDataPath();

    // flag.cssを取得
    $res = file_get_contents($cssPath, true);

    // 追加スタイルを準備
    $newClass = $this->prepareAddCssClass($className, $extension);

    $handle = fopen($this->getCssDataPath(), "a+");
    fwrite($handle, $newClass);
    fclose($handle);

    return;
  }

  /**
   * 画像ファイルをリネーム
   */
  public function renameImgFile($inputName, $extension)
  {
    return $inputName . $extension;
  }

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
}

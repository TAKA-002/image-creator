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


  /**
   * 画像ファイルをリネーム
   */
  public function renameImgFile($inputName, $extension)
  {
    return $inputName . $extension;
  }
}

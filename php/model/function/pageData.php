<?php

class pageData{

  /**
   * 表示しているページのディレクトリ名を返す。
   */
  public function getPageDir($selfPath){
   $result = explode("/", $selfPath);
   return $result[count($result) - 2];
  }

}
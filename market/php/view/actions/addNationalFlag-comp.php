<?php

// market内
require_once(__DIR__ . '/../../model/function/data.php');
$dataObj = new Data();

// 今ある国旗のリストを作成
$flagsList = $dataObj->getFlagJsonData();


// echo '<pre>';
// var_dump($flagsList);
// echo '</pre>';



echo '<pre>';
var_dump($_POST);
var_dump($_FILES["flag"]);
echo '</pre>';

// if($_FILES["flag"])

// 国旗名のvalidationチェック
foreach ($flagsList as $key => $value) {
  if (strtoupper($_POST["nationalFlagName"]) === strtoupper($flagsList[$key]["name"])) {
    echo "もう使われているからやりなおし";
    return false;
  }
  if (!preg_match('/^[a-zA-Z]+$/', $_POST["nationalFlagName"])) {
    echo "英字だけにしてやりなおし";
    return false;
  }
}



if (isset($_POST["upload"])) {
  $imgFileName = $_POST["nationalFlagName"];
}

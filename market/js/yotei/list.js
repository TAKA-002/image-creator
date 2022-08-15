// ======================================
// リスト自動表示
// ======================================
$(function () {
  $.ajax({
    type: "GET",
    url: "./data/data.json",
    dataType: "json",
    async: false,
  })
    .done((res) => {
      createTable(res);
    })
    .fail(() => {
      console.log("jsonファイルの読み込みに失敗しました。");
    });
});

/**
 *
 * @param {*} jsonObj
 * @returns
 */
function createTable(jsonObj) {
  // 全データの日付を抽出する
  let extractedDate = extractData(jsonObj);

  // 全データの日付を早い順に並べ替える
  let sortedTimestamp = sortAscending(extractedDate);

  // 日付ごと（画像の行ごと）に以下の処理を実施
  sortedTimestamp.forEach((timestamp) => {
    let plansLiTags = "";
    let outerTags = "";
    let day = createDate(timestamp);

    // 全データを上から検索。
    jsonObj.forEach((eachData) => {
      // それぞれのデータのdateのyyyymmddをタイムスタンプに変換し、同じだった場合にリストを生成する。
      if (timestamp === changeTimestamp(eachData.date)) {
        // .plansの内側liタグを生成
        plansLiTags += createPlanListTag(eachData);
      }
    });

    // .list__body-dateの内側を生成
    outerTags = createOuterTags(plansLiTags, day);
    $("#js-list").append(outerTags);
  });

  return;
}

/**
 * outerタグ
 * @param {*} data
 * @returns
 */
function createOuterTags(plansLiTags, timestamp) {
  return `<li class="list__body-date"><time>${timestamp}</time><ul class="plans">${plansLiTags}</ul></li>`;
}

/**
 * plansliタグ
 * @param {*} eachData
 * @returns テキスト
 */
function createPlanListTag(eachData) {
  if (eachData.paintParts != "") {
    let span = setSpan(eachData);
    let replacedtext = eachData.plan.replace(eachData.paintParts, span);
    return `<li class="icon-${eachData.nationalFlag}">${replacedtext}</li>`;
  } else {
    return `<li class="icon-${eachData.nationalFlag}">${eachData.plan}</li>`;
  }
}

/**
 *
 * @param {*} item
 * @returns
 */
function setSpan(eachData) {
  return `<span style="color: ${eachData.colorCode}">${eachData.paintParts}</span>`;
}

/**
 * timestampから「●月▲日（★）」を作成
 * @returns
 */
function createDate(timestamp) {
  const dayOfWeekStr = ["日", "月", "火", "水", "木", "金", "土"];
  let date = new Date(timestamp);
  let MM = date.getMonth() + 1; // 0埋めはしない
  let dd = date.getDate(); // 0埋めはしない
  let dayOfWeek = date.getDay();

  return `${MM}月${dd}日(${dayOfWeekStr[dayOfWeek]})`;
}

/**
 * data.jsonファイルのdateをすべて抽出する
 *
 * @params jsonObj - data.jsonの全データ
 * @returns extractedDate - 重複除外したitem["date"]のyyyymmdd
 */
function extractData(jsonObj) {
  let extractedDate = [];

  jsonObj.forEach((item) => {
    if (!extractedDate.includes(item["date"])) {
      extractedDate.push(item["date"]);
    }
  });

  return extractedDate;
}

/**
 * 抽出した日付の配列を、日付の古い順にソートする
 *
 */
function sortAscending(extractedDate) {
  let timestamps = [];

  // タイムスタンプに変換
  extractedDate.forEach((date) => {
    let d = changeTimestamp(date);
    timestamps.push(d);
  });

  // ソートする
  return sortTimestamp(timestamps);
}

/**
 *
 */
function changeTimestamp(date) {
  // yyyymmddを分解する
  let divided = divideDate(date);
  // 分解したyyyymmddからタイムスタンプを生成
  let d = new Date(divided[0], divided[1] - 1, divided[2]);

  return d.getTime();
}

/**
 * yyyymmdd を分割
 * @params Strings - "yyyymmdd"
 * @returns Array - ["yyyy", "mm", "dd"]
 */
function divideDate(date) {
  let divided = [];

  let y = parseInt(date.substr(0, 4)); // 0文字目〜4文字
  let m = parseInt(date.substr(4, 2)); // 5文字目〜2文字
  let d = parseInt(date.substr(6, 2)); // 7文字目〜2文字

  divided.push(y);
  divided.push(m);
  divided.push(d);

  return divided;
}

/**
 * 日付のタイムスタンプを並べ替えるバブルソート
 */
function sortTimestamp(timestamps) {
  for (let outer = 0; outer < timestamps.length; outer++) {
    for (let i = timestamps.length - 1; i > outer; i--) {
      if (timestamps[i] < timestamps[i - 1]) {
        let tmp = timestamps[i];
        timestamps[i] = timestamps[i - 1];
        timestamps[i - 1] = tmp;
      }
    }
  }
  return timestamps;
}

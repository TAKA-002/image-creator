// ======================================
// リスト自動表示
// ======================================
$(function () {
  $.ajax({
    type: "GET",
    url: "./data/imageTableData.json",
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
  // 全体のタグが作成されたあとの文字列を戻す
  let createdTags = createTableTags(jsonObj);

  $("#js-list").append(createdTags);
  return;
}

/**
 * 全タグをつなげた状態の文字列を作成する
 * @param {*} jsonObj
 * @returns
 */
function createTableTags(jsonObj) {
  let dateTxt = "";
  let createdTags = "";

  // jsonデータ予定日の数だけループ
  for (let i = 0; i < jsonObj.length; i++) {
    // timestampから「M月D日（月）」を作成（1回）
    dateTxt = createDate(jsonObj[i]["timestamp"]);

    // 予定の部分を作成（最深部のlistタグ）
    let plansLists = createList(jsonObj[i]["plansRow"]);

    // timestampとlistをulで囲む
    createdTags += createTags(plansLists, dateTxt);
  }
  return createdTags;
}

/**
 *
 * @param {*} data
 * @returns
 */
function createTags(plansLists, dateTxt) {
  let tags =
    `<li class="list__body-date">` +
    `<time>${dateTxt}</time>` +
    `<ul class="plans">${plansLists}</ul>` +
    `</li>`;

  return tags;
}

/**
 * liタグ
 * @param {*} arrayData
 * @returns テキスト
 */
function createList(arrayData) {
  let lists = "";

  arrayData.forEach((item) => {
    if (item.paintParts != "") {
      let span = setSpan(item);
      let replacedtext = item.plan.replace(item.paintParts, span);
      let list = `<li class="icon-${item.nationalFlag}">${replacedtext}</li>`;
      lists += list;
    } else {
      let list = `<li class="icon-${item.nationalFlag}">${item.plan}</li>`;
      lists += list;
    }
  });

  return lists;
}

/**
 *
 * @param {*} item
 * @returns
 */
function setSpan(item) {
  let spanTxt = `<span style="color: ${item.colorCode}">${item.paintParts}</span>`;

  return spanTxt;
}

/**
 * timestampから「●月▲日（★）」を作成
 * @returns
 */
function createDate(timestamp) {
  const dayOfWeekStr = ["日", "月", "火", "水", "木", "金", "土"];

  let timestampNum = parseInt(timestamp); // 数値へ変換
  let date = new Date(timestampNum * 1000); // ミリ秒へ

  let MM = date.getMonth() + 1; // 0埋めはしない
  let dd = date.getDate(); // 0埋めはしない
  let dayOfWeek = date.getDay();
  return `${MM}月${dd}日(${dayOfWeekStr[dayOfWeek]})`;
}

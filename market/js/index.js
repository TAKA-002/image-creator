// ======================================
// スムーススクロール
// ======================================
$(function () {
  // #で始まるリンクをクリックした場合
  $('a[href^="#"]').click(function () {
    // スクロールの速度
    let speed = 400;

    // スクロールタイプ
    let type = "swing";

    // href属性の取得
    let href = $(this).attr("href");

    // 移動先の取得（hrefが#indexならトップ$(html)に、）
    let target = $(href == "#index" ? "html" : href);

    // 移動先のポジション取得
    let position = target.offset().top;

    // animateでスムーススクロール
    $("body,html").animate({ scrollTop: position }, speed, type);
    return false;
  });
});

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

function createTable(jsonObj) {
  let createdTags = createTableData(jsonObj);

  $("#js-list").append(createdTags);
  return;
}

function createTableData(jsonObj) {
  // listsFolderを入れるストレージのイメージ
  let listsStrage = [];

  // listsTxtを入れるフォルダーのようなイメージ
  let listsFolder = [];
  let createdTags = "";

  // リストのtagを作成する
  Object.keys(jsonObj).forEach((key) => {
    // timestampをまず配列0に格納
    listsFolder.push(jsonObj[key]["timestamp"]);

    // timestampに対応しているlistを作成して格納
    let listsTxt = createTags(jsonObj[key]);
    listsFolder.push(listsTxt);
    console.log("listsFolder：", typeof listsFolder);
  });
  // console.log(listsStrage);

  return;

  aryData.forEach((each) => {
    let text = createTags(each);
    createdTags += text;
  });

  return createdTags;
}

function createTags(data) {
  let lists = createList(data);
  let tags =
    `<li class="list__body-date">` +
    `<time>${data.days}</time>` +
    `<ul class="plans">` +
    lists +
    `</ul>` +
    `</li>`;

  return tags;
}

// liタグ
function createList(data) {
  let lists = "";

  data.plansRow.forEach((item) => {
    // paintPartsデータが空じゃなかったらspanタグを挿入
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

function setSpan(item) {
  let spanTxt = `<span style="color: ${item.colorCode}">${item.paintParts}</span>`;

  return spanTxt;
}

// ======================================
// html2capture（ほぼインスパイア（パクリ）したコード）
// ======================================
$(function () {
  /* プレビュー click !!  */
  $(document).on("click", "#preview", function () {
    html2canvas(document.querySelector("#capture")).then(function (canvas) {
      $("#previewImage").empty();
      $("#previewImage").append(canvas);
    });
  });

  /* Image コンバート → Download */
  $(document).on("click", "#outImage", function () {
    html2canvas(document.querySelector("#capture")).then((canvas) => {
      var imgageData = canvas.toDataURL("image/jpg");
      // a id="download" に ダウンロード設定
      $("#download")
        .attr("download", "web-feature-article-capture.jpg")
        .attr(
          "href",
          imgageData.replace(
            /^data:image\/jpg/,
            "data:application/octet-stream"
          )
        );
      // ダウンロード発火
      var evt = document.createEvent("MouseEvents");
      evt.initMouseEvent(
        "click",
        true,
        true,
        window,
        0,
        0,
        0,
        0,
        0,
        false,
        false,
        false,
        false,
        0,
        null
      );
      document.getElementById("download").dispatchEvent(evt);
    });
  });
});

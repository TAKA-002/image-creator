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
    url: "/WEB-Feature-Image-Creator/data/data.json",
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
  let aryData = [];
  let createdTags = "";
  let row_1;
  let row_2;
  let row_3;
  let row_4;
  let row_5;
  let row_6;
  let row_7;
  let row_8;
  let row_9;
  let row_10;

  jsonObj.forEach((ary) => {
    Object.keys(ary).forEach((item) => {
      if (item == "row_1") {
        row_1 = jsonObj[0][item];
      }
      if (item == "row_2") {
        row_2 = jsonObj[0][item];
      }
      if (item == "row_3") {
        row_3 = jsonObj[0][item];
      }
      if (item == "row_4") {
        row_4 = jsonObj[0][item];
      }
      if (item == "row_5") {
        row_5 = jsonObj[0][item];
      }
      if (item == "row_6") {
        row_6 = jsonObj[0][item];
      }
      if (item == "row_7") {
        row_7 = jsonObj[0][item];
      }
      if (item == "row_8") {
        row_8 = jsonObj[0][item];
      }
      if (item == "row_9") {
        row_9 = jsonObj[0][item];
      }
      if (item == "row_10") {
        row_10 = jsonObj[0][item];
      }
    });
  });

  if (row_1.isShow) {
    aryData.push(row_1);
  }
  if (row_2.isShow) {
    aryData.push(row_2);
  }
  if (row_3.isShow) {
    aryData.push(row_3);
  }
  if (row_4.isShow) {
    aryData.push(row_4);
  }
  if (row_5.isShow) {
    aryData.push(row_5);
  }
  if (row_6.isShow) {
    aryData.push(row_6);
  }
  if (row_7.isShow) {
    aryData.push(row_7);
  }
  if (row_8.isShow) {
    aryData.push(row_8);
  }
  if (row_9.isShow) {
    aryData.push(row_9);
  }
  if (row_10.isShow) {
    aryData.push(row_10);
  }


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
  let spanTxt = `<span style="color: ${item.colorCode}">${item.paintParts}</span>`

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

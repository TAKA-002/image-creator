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

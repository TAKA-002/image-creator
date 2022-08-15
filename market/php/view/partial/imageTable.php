<div class="w-max relative">
  <span style="top: -80px; left:-10px;" class="animate-bounce absolute z-10 bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">■ 画像ダウンロード手順<br>1. 黒い見出しの上を右クリックして「検証」を選択<br>2. 検証画面Elementsタブの「id="capture"のdivタグ」を右クリック<br>3.「Capture node screenshot」を選択</span>
  <div class="relative z-0 shadow-lg px-4 py-6 w-full bg-white relative">
    <!-- chromeの検証ツールでキャプチャーを取る場合は「id="capture"」のタグで実行してください。 -->
    <div id="capture" class="list">
      <div class="list__header">
        <h3 class="list__header-text">注目予定<span>(いずれも日本時間)</span></h3>
      </div>
      <div class="list__body">
        <ul id="js-list" class="list__body-wrap"></ul>
      </div>
    </div>
  </div>
</div>

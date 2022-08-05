<div class="mr-8">

  <div class="shadow-lg px-4 py-6 bg-white relative" style="width: 1200px;">

    <div class="mx-auto mt-8">

      <!-- 見出し・操作ボタン -->
      <div class="mb-4">
        <h1 class="font-sanserif text-3xl font-bold">新規データ追加</h1>
        <div class="flex justify-start mt-10">
          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="4">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75" autofocus>国旗追加</button>
          </form>
          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="1">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75" autofocus>データ一覧へ</button>
          </form>
        </div>
      </div>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
        <form method="POST" action="./create-comp.php">
          <!-- ID -->
          <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="listid" type="hidden" name="id" value="<?php echo $createdId; ?>" />

          <!-- 年月日 -->
          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listDate">年月日（yyyymmdd形式）<span class="text-pink-500 text-xs ml-3">必須</span></label>

            <input id="listDate" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="date" placeholder="予定項目の年月日を入力してください。（例：20220715）" required />
          </div>

          <!-- 国旗 -->
          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="displayNum">国旗</label>

            <select id="displayNum" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="dispTop">
              <option value="0" selected>テキスト横に国旗を表示しない</option>
              <option value="1">1番目</option>
              <option value="2">2番目</option>
              <option value="3">3番目</option>
              <option value="4">4番目</option>
            </select>
          </div>

          <!-- テキスト -->
          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listTitle">テキスト<span class="text-pink-500 text-xs ml-3">必須</span></label>

            <input id="listTitle" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="title" placeholder="注目予定テキストを入力してください。（例：FOMC FRBパウエル議長会見）" required />
          </div>

          <!-- 色付け部分 -->
          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listURL">色付け部分</label>

            <input id="listURL" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="url" placeholder="予定文の中で色をつけたい箇所を記入してください。（例：パウエル）" />
          </div>

          <!-- カラー -->
          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listTmb">カラー</label>

            <input id="listTmb" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="img" placeholder="色を付けたい部分のカラーを入力してください。（例：red, #fff）" />
          </div>


          <!-- BUTTON -->
          <div class="flex items-center justify-start mt-8 gap-x-2">
            <button type="submit" class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">データ作成・追加</button>
          </div>
        </form>
      </div>

    </div>

  </div>

</div>
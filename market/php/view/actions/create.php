<div class="mr-8">

  <div class="shadow-lg px-4 py-6 bg-white relative" style="width: 1200px;">

    <div class="mx-auto mt-8">

      <div class="mb-4">
        <h1 class="font-sanserif text-3xl font-bold">注目予定追加</h1>
        <div class="flex justify-start mt-10">
          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="nationalflag">
            <input type="hidden" name="opeDataFlag" value="nodata">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75">国旗追加</button>
          </form>
          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="list">
            <input type="hidden" name="opeDataFlag" value="nodata">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75">リスト表示</button>
          </form>
        </div>
      </div>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
        <form action="" method="POST">
          <input type="hidden" name="dispFlag" value="list">
          <input type="hidden" name="opeDataFlag" value="created">
          <input name="chkno" type="hidden" value="<?php echo $chkno; ?>">

          <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="listid" type="hidden" name="id" value="<?php echo $createdId; ?>" />

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listDate">年月日（yyyymmdd形式）<span class="text-pink-500 text-xs ml-3">※必須</span></label>

            <input id="listDate" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="date" placeholder="予定項目の年月日を入力してください。曜日自動取得のため「年」必須です。（例：20220715）" required autofocus />
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="nationalFlag">国旗</label>

            <select id="nationalFlag" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="nationalFlag">
              <?php for ($i = 0; $i < count($flagsList); $i++) : ?>
                <option value="<?php echo $flagsList[$i]["name"]; ?>" style=""><?php echo $flagsList[$i]["display"]; ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="plan">テキスト<span class="text-pink-500 text-xs ml-3">※必須</span></label>

            <input id="plan" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="plan" placeholder="注目予定テキストを入力してください。（例：FOMC FRBパウエル議長会見）" required />
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="paintParts">着色テキスト</label>

            <input id="paintParts" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="paintParts" placeholder="予定文の中で色をつけたい箇所を記入してください。（例：パウエル）" />
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="colorCode">カラー</label>

            <input id="colorCode" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="colorCode" placeholder="色を付けたい部分のカラーを入力してください。（例：red, #fff）" />
          </div>

          <div class="flex items-center justify-start mt-8 gap-x-2">
            <button type="submit" class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">データ作成・追加</button>
          </div>
        </form>
      </div>

    </div>

  </div>

</div>
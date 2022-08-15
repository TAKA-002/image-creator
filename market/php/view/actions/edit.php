<div class="mr-8">

  <div class="shadow-lg px-4 py-6 bg-white relative" style="width: 1200px;">

    <div class="mx-auto mt-8">

      <div class="mb-4">
        <h1 class="font-sanserif text-3xl font-bold">編集</h1>
        <div class="flex justify-start mt-10">
          <form action="" method="POST">
            <input type="hidden" name="opeDataFlag" value="nodata">
            <input type="hidden" name="dispFlag" value="list">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75">リストへ</button>
          </form>
        </div>
      </div>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
        <form action="" method="POST">

          <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="listid" type="hidden" name="id" value="<?php echo $targetEditData["id"]; ?>" />

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listDate">年月日（yyyymmdd形式）<span class="text-pink-500 text-xs ml-3">必須</span></label>

            <input id="listDate" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="date" value="<?php echo $targetEditData["date"] ?>" required autofocus />
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="displayNum">国旗</label>

            <select id="displayNum" class="block w-full mt-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="nationalFlag">
              <?php for ($i = 0; $i < count($flagsList); $i++) : ?>
                <?php if ($targetEditData["nationalFlag"] === $flagsList[$i]["name"]) : ?>
                  <option value="<?php echo $flagsList[$i]["name"]; ?>" selected><?php echo $flagsList[$i]["display"]; ?></option>
                <?php else : ?>
                  <option value="<?php echo $flagsList[$i]["name"]; ?>"><?php echo $flagsList[$i]["display"]; ?></option>
                <?php endif; ?>
              <?php endfor; ?>
            </select>
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="plan">テキスト<span class="text-pink-500 text-xs ml-3">必須</span></label>

            <input id="plan" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="plan" value="<?php echo $targetEditData["plan"] ?>" required />
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listURL">色付け部分</label>

            <input id="listURL" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="paintParts" value="<?php echo $targetEditData["paintParts"] ?>" />
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="listTmb">カラー</label>

            <input id="listTmb" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="colorCode" value="<?php echo $targetEditData["colorCode"] ?>" />
          </div>

          <input type="hidden" name="dispFlag" value="list">
          <input type="hidden" name="opeDataFlag" value="edited">

          <div class="flex items-center justify-start mt-8 gap-x-2">
            <button type="submit" class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">編集データ保存</button>
          </div>
        </form>
      </div>

    </div>

  </div>

</div>

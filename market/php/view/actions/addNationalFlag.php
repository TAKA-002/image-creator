<div class="mr-8">

  <div class="flex shadow-lg px-4 py-6 bg-white relative" style="width: 1200px;">

    <div class="w-1/2 mx-auto mt-8">

      <div class="mb-4">
        <h1 class="font-sanserif text-3xl font-bold">国旗追加</h1>
        <div class="flex justify-start mt-10">
          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="create">
            <input type="hidden" name="opeDataFlag" value="nodata">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75">注目予定追加</button>
          </form>
          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="list">
            <input type="hidden" name="opeDataFlag" value="nodata">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75">リスト表示</button>
          </form>
        </div>
      </div>

      <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
        <form action="./php/view/actions/addNationalFlag-comp.php" method="POST" enctype="multipart/form-data">

          <div class="mt-8">
            <label class="form-label block text-sm font-bold text-gray-700" for="flagImgFile">ファイル<span class="text-pink-500 text-xs ml-3">※必須 w34px h23pxの画像を選択してください。</span></label>
            <div class="my-3 w-full">
              <input class="form-control block w-full px-3 py-3 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="flagImgFile" name="uploadFile" required autofocus>
            </div>
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="flagName">CSSクラス名・画像ファイル名<span class="text-pink-500 text-xs ml-3">※必須</span></label>

            <input id="flagName" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="nationalFlagName" placeholder="国旗の略名を半角英字で入力してください。（例 US）" required />
          </div>

          <div class="mt-8">
            <label class="block text-sm font-bold text-gray-700" for="countryName">国名<span class="text-pink-500 text-xs ml-3">※必須</span></label>

            <input id="countryName" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="countryName" placeholder="国旗の国名を入力してください。（例 アメリカ）" required />
          </div>

          <div class="flex items-center justify-start mt-8 gap-x-2">
            <button type="submit" name="upload" value="追加" class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">追加</button>
          </div>
        </form>
      </div>

    </div>

    <div class="w-1/2 mx-auto mt-8 pl-4">
      <div class="mb-4">
        <h1 class="font-sanserif text-3xl font-bold">登録済 国旗データ表</h1>
      </div>
      <div class="border-t border-gray-200 mt-10 text-center shadow-lg">
        <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b-2 border-gray-400">
            <dt>アイコン</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0">CSS・画像ファイル名</dd>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0">国名</dd>
          </div>

          <?php foreach ($flagsList as $key => $value) : ?>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b-2 border-gray-200">
              <dt><img class="my-0 mx-auto" src="<?php echo $flagsList[$key]["img"] ?>" alt=""></dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0"><?php echo $flagsList[$key]["name"] ?></dd>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0"><?php echo $flagsList[$key]["display"] ?></dd>
            </div>
          <?php endforeach; ?>

        </dl>
      </div>
    </div>

  </div>

</div>
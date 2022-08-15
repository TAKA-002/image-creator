<div class="mr-8">

  <div class="shadow-lg px-4 py-6 bg-white relative" style="width: 1200px;">

    <div class="mx-auto mt-8">

      <div class="mb-4">
        <h1 class="font-sanserif text-3xl font-bold">リスト</h1>
        <div class="flex justify-start mt-10">

          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="create">
            <input type="hidden" name="opeDataFlag" value="nodata">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75" autofocus>新規追加</button>
          </form>

          <form action="" method="POST">
            <input type="hidden" name="dispFlag" value="nationalflag">
            <input type="hidden" name="opeDataFlag" value="nodata">
            <button style="background-color: rgb(30 41 59);" class="px-4 py-2 mx-2 rounded-md text-white hover:opacity-75">国旗追加</button>
          </form>

          <button class="px-4 py-2 mx-2 rounded-md text-white bg-red-700 hover:bg-opacity-75" id="outImage" type="button">Download（不調）</button>
          <a id="download" href="#"></a>

          <!-- 
          <form action="./php/view/actions/transformData.php" method="POST">
            <input type="hidden" name="opeDataFlag" value="transform">
            <button type="submit" class="px-4 py-2 mx-2 rounded-md text-white bg-red-700 hover:bg-opacity-75">画像用JSON作成</button>
          </form>
          -->
        </div>
      </div>

      <div class="overflow-x-scroll">
        <table class="table-fixed w-full">
          <thead>
            <tr>
              <th style=" width: 80px;" class="py-3 px-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 border-b border-gray-200 bg-gray-50">MOVE</th>
              <th style="width: 120px;" class="py-3 px-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 border-b border-gray-200 bg-gray-50">年月日</th>
              <th style="width: 120px;" class="py-3 px-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 border-b border-gray-200 bg-gray-50">国旗</th>
              <th style="width: 440px" class="py-3 px-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 border-b border-gray-200 bg-gray-50">テキスト</th>
              <th style="width: 200px;" class="py-3 px-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 border-b border-gray-200 bg-gray-50">色付け部分</th>
              <th style="width: 120px;" class="py-3 px-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 border-b border-gray-200 bg-gray-50">カラー</th>
              <th style="width: 80px;" class="py-3 px-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="3">編集</th>
            </tr>
          </thead>

          <tbody class="bg-white">
            <?php foreach ($targetJsonData as $key => $listData) : ?>
              <tr>
                <input type="hidden" name="id" value="<?php echo $listData["id"]; ?>">

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <form action="" method="POST" class="m-0 text-center leading-none" style="line-height: 7px;">
                    <input type="hidden" name="opeDataFlag" value="up">
                    <input type="hidden" name="dispFlag" value="list">
                    <input type="hidden" name="key" value="<?php echo $key ?>">
                    <input type="hidden" name="id" value="<?php echo $listData["id"] ?>">

                    <button type="submit" class="cursor-pointer">
                      <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6L5 2L9 6" stroke="#AFAFAF" stroke-width="2" />
                      </svg>
                    </button>
                  </form>

                  <form action="" method="POST" class="mt-4 mb-0 text-center" style="line-height: 7px;">
                    <input type="hidden" name="opeDataFlag" value="down">
                    <input type="hidden" name="dispFlag" value="list">
                    <input type="hidden" name="key" value="<?php echo $key ?>">
                    <input type="hidden" name="id" value="<?php echo $listData["id"] ?>">

                    <button type="submit" class="cursor-pointer">
                      <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 1L5 5L1 1" stroke="#AFAFAF" stroke-width="2" />
                      </svg>
                    </button>
                  </form>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900"><?php echo $listData["date"]; ?></div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="flex items-center text-sm leading-5 text-gray-900">
                    <span style="width:40px; height:30px;" class="icon icon-<?php echo $listData["nationalFlag"] ?>"></span>
                    <span class="w-1/2 text-center"><?php echo $listData["nationalFlag"]; ?></span>
                  </div>
                </td>

                <td class="px-3 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900"><?php echo $listData["plan"] ?></div>
                </td>

                <td class="px-3 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900"><?php echo $listData["paintParts"] ?></div>
                </td>

                <td class="px-3 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900"><?php echo $listData["colorCode"] ?></div>
                </td>

                <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                  <form action="" method="POST">
                    <input type="hidden" name="opeDataFlag" value="nodata">
                    <input type="hidden" name="dispFlag" value="edit">
                    <input type="hidden" name="id" value="<?php echo $listData["id"]; ?>">
                    <input type="hidden" name="date" value="<?php echo $listData["date"]; ?>">
                    <input type="hidden" name="nationalFlag" value="<?php echo $listData["nationalFlag"]; ?>">
                    <input type="hidden" name="plan" value="<?php echo $listData["plan"]; ?>">
                    <input type="hidden" name="paintParts" value="<?php echo $listData["paintParts"]; ?>">
                    <input type="hidden" name="colorCode" value="<?php echo $listData["colorCode"]; ?>">

                    <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </button>
                  </form>
                </td>

                <td class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                  <form action="" method="POST">
                    <input type="hidden" name="dispFlag" value="list">
                    <input type="hidden" name="opeDataFlag" value="deleted">
                    <input type="hidden" name="id" value="<?php echo $listData["id"]; ?>">
                    <button type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>

    </div>

  </div>

</div>

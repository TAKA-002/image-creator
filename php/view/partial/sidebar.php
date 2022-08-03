<div class="bg-white h-full rounded-2xl" style="width:320px;">
  <div class="flex items-center justify-center pt-6">
    <p class="font-bold text-xl">Image Creator</p>
  </div>

  <nav class="mt-6">
    <div>

      <!-- HOME start -->
      <form action="/image-creator/" method="POST">
        <input type="hidden" name="pos" value="image-creator">

        <?php if ($pageDir === "image-creator") : ?>
          <button type="submit" class="w-full font-thin uppercase text-blue-500 flex items-center p-4 my-2 transition-colors duration-200 justify-start bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500">
          <?php else : ?>
            <button type="submit" class="w-full font-thin uppercase text-gray-500 flex items-center p-4 my-2 transition-colors duration-200 justify-start hover:text-blue-500">
            <?php endif; ?>
            <span class="text-left">
              <img src="/image-creator/common/images/icon/home.svg" width="20px" height="20px" alt="">
            </span>
            <span class="mx-4 text-sm font-normal">HOME</span>
            </button>
      </form>
      <!-- HOME end -->

      <!-- market start -->
      <form action="/image-creator/market/" method="POST">
        <input type="hidden" name="pos" value="market">
        <input type="hidden" name="dispFlag" value="1">

        <?php if ($pageDir === "market") : ?>
          <button type="submit" class="w-full font-thin uppercase text-blue-500 flex items-center p-4 my-2 transition-colors duration-200 justify-start bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500">
          <?php else : ?>
            <button type="submit" class="w-full font-thin uppercase text-gray-500 flex items-center p-4 my-2 transition-colors duration-200 justify-start hover:text-blue-500">
            <?php endif; ?>
            <span class="text-left">
              <img src="/image-creator/market/image/icon/market.svg" width="20px" height="20px" alt="">
            </span>
            <span class="mx-4 text-sm font-normal">マーケットコラム興味津々<br>注目予定</span>
            </button>
      </form>
      <!-- market end -->

      <!-- 追加時使用テンプレート start -->
      <!-- actionに遷移先を記述 -->
      <form action="" method="POST">
        <input type="hidden" name="pos" value="market">
        <input type="hidden" name="dispFlag" value="1">

        <!-- ディレクトリ名を記述 -->
        <?php if ($pageDir === "/") : ?>
          <button type="submit" class="w-full font-thin uppercase text-blue-500 flex items-center p-4 my-2 transition-colors duration-200 justify-start bg-gradient-to-r from-white to-blue-100 border-r-4 border-blue-500 border-r-4 border-blue-500">
          <?php else : ?>
            <button type="submit" class="w-full font-thin uppercase text-gray-500 flex items-center p-4 my-2 transition-colors duration-200 justify-start hover:text-blue-500">
            <?php endif; ?>
            <span class="text-left">
              <img src="/image-creator/common/images/icon/nodecide.svg" width="20px" height="20px" alt="">
            </span>
            <span class="mx-4 text-sm font-normal">追加時使用テンプレート</span>
            </button>
      </form>
      <!-- 追加時使用テンプレート end -->

    </div>
  </nav>
</div>

<section class="py-16 px-4 md:px-20 bg-white">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:items-stretch gap-8">

    <!-- Carousel Ảnh -->
    <div class="flex-1 order-1 md:order-2">
      <section id="carousel" class="relative w-full h-full overflow-hidden">

        <!-- Slides wrapper -->
        <div id="slides" class="flex transition-transform duration-500 ease-in-out h-full">
          <div class="carousel-slide min-w-full h-full">
            <img src="images/sample.jpg" alt="Slide 1" class="w-full h-full object-cover rounded-lg">
          </div>
          <div class="carousel-slide min-w-full h-full">
            <img src="images/sample.jpg" alt="Slide 2" class="w-full h-full object-cover rounded-lg">
          </div>
          <div class="carousel-slide min-w-full h-full">
            <img src="images/sample.jpg" alt="Slide 3" class="w-full h-full object-cover rounded-lg">
          </div>
        </div>

        <!-- Prev/Next Buttons -->
        <button id="prevBtn" class="absolute top-1/2 left-2 -translate-y-1/2 bg-white/70 hover:bg-white text-gray-800 font-bold py-2 px-3 rounded-full shadow-md">‹</button>
        <button id="nextBtn" class="absolute top-1/2 right-2 -translate-y-1/2 bg-white/70 hover:bg-white text-gray-800 font-bold py-2 px-3 rounded-full shadow-md">›</button>

        <!-- Indicators -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
          <button class="indicator w-3 h-3 bg-gray-800 rounded-full bg-opacity-40 scale-100 transition-all" data-index="0"></button>
          <button class="indicator w-3 h-3 bg-gray-800 rounded-full bg-opacity-40 scale-100 transition-all" data-index="1"></button>
          <button class="indicator w-3 h-3 bg-gray-800 rounded-full bg-opacity-40 scale-100 transition-all" data-index="2"></button>
        </div>

      </section>
    </div>

    <!-- Nội dung -->
    <div class="flex-1 flex flex-col justify-center order-2 md:order-1">
      <h3 class="text-2xl md:text-3xl font-bold mb-6 text-center md:text-left">
        NỘI THẤT TRANG TRÍ
      </h3>

      <div class="space-y-4 text-justify text-sm md:text-base leading-relaxed">
        <p>HomeDecor mang đến những giải pháp nội thất trang trí hiện đại, tinh tế và phù hợp với từng không gian sống. Từ phòng khách, phòng ngủ đến phòng bếp, từng chi tiết đều được chăm chút để tạo nên tổng thể hài hòa và thẩm mỹ.</p>

        <p>Chúng tôi kết hợp giữa sự sáng tạo trong thiết kế và chất lượng thi công cao cấp, giúp biến những ý tưởng của khách hàng thành hiện thực sống động. Nội thất không chỉ là tiện nghi mà còn là trải nghiệm, tạo cảm giác ấm cúng và sang trọng cho ngôi nhà.</p>

        <p>Với HomeDecor, mỗi sản phẩm nội thất là một tác phẩm riêng biệt, thể hiện phong cách cá nhân của chủ nhân. Chúng tôi cam kết đem đến sự bền bỉ, tính thẩm mỹ và sự tiện nghi, đồng thời mang đến không gian sống trọn vẹn, tinh tế và đầy cảm hứng.</p>
      </div>
    </div>

  </div>
</section>

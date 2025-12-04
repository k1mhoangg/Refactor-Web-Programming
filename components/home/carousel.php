<section class="w-full mx-auto px-4 mt-6">
    <div class="relative group">
        <!-- Slides wrapper -->
        <div id="carousel" class="overflow-hidden relative w-full m-0 p-0">
            <div id="slides" class="flex transition-transform duration-500 ease-in-out w-full m-0 p-0">
                <!-- Slide 1 -->
                <div class="carousel-slide flex-none w-full relative">
                    <img src="images/sample.jpg" alt="Phòng khách trang trí"
                        class="w-full h-56 sm:h-72 md:h-96 lg:h-[112] object-cover rounded-lg shadow-md">
                    <div class="absolute left-4 bottom-6 bg-black bg-opacity-40 text-white px-3 py-2 rounded z-10">
                        <h3 class="text-lg font-semibold">Thiết kế phòng khách</h3>
                        <p class="text-sm">Phong cách hiện đại, tối giản</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-slide flex-none w-full relative">
                    <img src="images/phong_ngu1.jpg" alt="Phòng ngủ đẹp"
                        class="w-full h-56 sm:h-72 md:h-96 lg:h-[112] object-cover rounded-lg shadow-md">
                    <div class="absolute left-4 bottom-6 bg-black bg-opacity-40 text-white px-3 py-2 rounded z-10">
                        <h3 class="text-lg font-semibold">Phòng ngủ ấm cúng</h3>
                        <p class="text-sm">Tối ưu ánh sáng và tiện nghi</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-slide flex-none w-full relative">
                    <img src="images/sample.jpg" alt="Bàn ăn trang trí"
                        class="w-full h-56 sm:h-72 md:h-96 lg:h-[112] object-cover rounded-lg shadow-md">
                    <div class="absolute left-4 bottom-6 bg-black bg-opacity-40 text-white px-3 py-2 rounded z-10">
                        <h3 class="text-lg font-semibold">Khu vực ăn uống</h3>
                        <p class="text-sm">Trang trí tinh tế cho bữa cơm gia đình</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prev Button -->
        <button id="prevBtn" aria-label="Previous" class="absolute left-2 top-1/2 transform -translate-y-1/2 
         bg-white text-gray-800 rounded-full p-2 shadow
         bg-opacity-90 hover:bg-opacity-100
         block sm:group-hover:block">
            <i class="fa fa-chevron-left"></i>
        </button>

        <!-- Next Button -->
        <button id="nextBtn" aria-label="Next" class="absolute right-2 top-1/2 transform -translate-y-1/2 
         bg-white text-gray-800 rounded-full p-2 shadow
         bg-opacity-90 hover:bg-opacity-100
         block sm:group-hover:block">
            <i class="fa fa-chevron-right"></i>
        </button>


        <!-- Indicators -->
        <div id="indicators" class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex gap-2">
            <button class="indicator w-3 h-3 rounded-full bg-white bg-opacity-60" data-index="0"
                aria-label="Slide 1"></button>
            <button class="indicator w-3 h-3 rounded-full bg-white bg-opacity-40" data-index="1"
                aria-label="Slide 2"></button>
            <button class="indicator w-3 h-3 rounded-full bg-white bg-opacity-40" data-index="2"
                aria-label="Slide 3"></button>
        </div>
    </div>
</section>
<!-- SECTION 1: Sản phẩm nổi bật -->
<div class="w-[90%] mx-auto bg-white mt-8 p-4 shadow-md rounded-lg">
    <h2 class="text-center text-xl font-semibold mb-4 border-b pb-2">SẢN PHẨM NỔI BẬT</h2>

    <div class="flex flex-wrap justify-center gap-4">
        <?php if (!empty($featuredProducts)):
            foreach ($featuredProducts as $product): ?>
                <!-- Product Card -->
                <div class="flex flex-col items-center w-28">
                    <a href="/product/<?php echo htmlspecialchars($product['id']); ?>">
                        <img src="<?php echo htmlspecialchars($product['image_url'] ?? 'images/sample.jpg'); ?>"
                            class="w-full h-20 object-cover rounded-md mb-2"
                            alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </a>
                    <p class="text-xs text-center font-medium uppercase line-clamp-2">
                        <?php echo htmlspecialchars($product['name']); ?>
                    </p>
                    <p class="text-xs text-center text-gray-600 mt-1">
                        <?php echo number_format($product['price']); ?>₫
                    </p>
                </div>
            <?php endforeach; else: ?>
            <p class="text-gray-500">Chưa có sản phẩm nổi bật</p>
        <?php endif; ?>
    </div>
</div>

<!-- SECTION 2: Sản phẩm mới nhất -->
<div class="w-[90%] mx-auto bg-white mt-10 p-4 shadow-md rounded-lg">
    <h2 class="text-center text-xl font-semibold mb-4 border-b pb-2">SẢN PHẨM MỚI NHẤT</h2>

    <div class="flex flex-wrap justify-between gap-6">
        <?php if (!empty($recentProducts)):
            foreach ($recentProducts as $product): ?>
                <!-- Project Card -->
                <div class="flex flex-col w-[30%] bg-gray-100 rounded-md shadow-sm overflow-hidden">
                    <a href="/product/<?php echo htmlspecialchars($product['id']); ?>">
                        <img src="<?php echo htmlspecialchars($product['image_url'] ?? 'images/sample.jpg'); ?>"
                            class="h-40 w-full object-cover" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </a>
                    <div class="p-3 flex flex-col gap-2">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span><?php echo htmlspecialchars($product['category'] ?? 'Nội thất'); ?></span>
                        </div>
                        <h3 class="font-semibold text-sm line-clamp-2">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h3>
                        <p class="text-xs text-gray-600 line-clamp-3">
                            <?php echo htmlspecialchars(substr($product['description'] ?? '', 0, 100)); ?>...
                        </p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-sm font-bold text-blue-600">
                                <?php echo number_format($product['price']); ?>₫
                            </span>
                            <?php if (!empty($product['discount_price'])): ?>
                                <span class="text-xs text-gray-400 line-through">
                                    <?php echo number_format($product['discount_price']); ?>₫
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; else: ?>
            <p class="text-gray-500 w-full text-center">Chưa có sản phẩm mới</p>
        <?php endif; ?>
    </div>
</div>
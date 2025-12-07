<?php

namespace Controller\Frontend;

use Model\Product;

class HomeController
{
    public function index()
    {
        // Lấy sản phẩm nổi bật (is_featured = 1) và sản phẩm mới nhất
        $featuredProducts = Product::getFeatured(6); // lấy 6 sản phẩm nổi bật
        $recentProducts = Product::getRecent(6);     // lấy 6 sản phẩm mới nhất

        require_once BASE_PATH . 'view/frontend/home.php';
    }
}
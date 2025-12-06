<?php

namespace Controller\Frontend;

use Model\Product;
use Model\HomeSettings;

class HomeController
{
    public function index()
    {
        $homeSettings = HomeSettings::getSettings();
        $slides = HomeSettings::getSlides(true);
        $banners = HomeSettings::getBanners(true);

        // Featured products: ưu tiên danh sách được admin chọn
        $featuredProducts = [];
        $featuredIds = HomeSettings::parseSelectedIds($homeSettings['featured_product_ids'] ?? '');
        if (!empty($featuredIds)) {
            $featuredProducts = Product::findByIds($featuredIds);
        } else {
            $count = (int) ($homeSettings['featured_count'] ?? 6);
            $featuredProducts = ($homeSettings['show_featured'] ?? 1) ? Product::getFeatured($count) : [];
        }

        // Recent products: ưu tiên danh sách được admin chọn
        $recentProducts = [];
        $recentIds = HomeSettings::parseSelectedIds($homeSettings['recent_product_ids'] ?? '');
        if (!empty($recentIds)) {
            $recentProducts = Product::findByIds($recentIds);
        } else {
            $count = (int) ($homeSettings['recent_count'] ?? 6);
            $recentProducts = ($homeSettings['show_recent'] ?? 1) ? Product::getRecent($count) : [];
        }

        require_once BASE_PATH . 'view/frontend/home.php';
    }
}
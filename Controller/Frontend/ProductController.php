<?php
namespace Controller\Frontend;

class ProductController
{
    public function detail($id)
    {
        require_once BASE_PATH . '/Model/Product.php';
        $product = \Model\Product::findById((int)$id);
        if (!$product) {
            http_response_code(404);
            require BASE_PATH . '/view/frontend/404.php';
            return;
        }
        require BASE_PATH . '/view/frontend/product_detail.php';
    }
}

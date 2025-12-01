<?php

namespace Controller\Frontend;

class HomeController
{
    public function index()
    {
        require_once BASE_PATH . 'view/frontend/home.php';
    }
}
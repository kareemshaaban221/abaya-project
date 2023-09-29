<?php

namespace App\Controllers\Website;

use App\Middlewares\IsGuest;
use App\Middlewares\IsAuth;
use App\Models\Farmer;
use App\Models\Product;
use App\Services\ProductService;
use Core\Auth;

class HomeController {

    protected ProductService $productService;

    public function __construct() {
        $this->productService = ProductService::getInstance();
    }

    public function index() {
        $farmers = Farmer::acceptedFarmers();
        foreach ($farmers as &$farmer)
            $farmer['rating'] = Farmer::rating($farmer['id']);
        return view('website.home', compact('farmers'));
    }

    public function farmers() {
        $farmers = Farmer::acceptedFarmers();
        foreach ($farmers as &$farmer)
            $farmer['rating'] = Farmer::rating($farmer['id']);
        return view('website.farmers', compact('farmers'));
    }

    public function products() {
        $products = $this->productService->getAllProductsWithFarmerRating();
        return view('website.products', compact('products'));
    }

    public function logout() {
        middleware(IsAuth::class);
        Auth::logout();
        return redirect('/', ['done' => 'تم تسجيل الخروج.']);
    }
}

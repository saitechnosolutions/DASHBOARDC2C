<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\VendorOffers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller {
    public function index() {
        try {
            $categoryCount = Category::where( 'status', '1' )->count();
            $subcategoryCount = SubCategory::where( 'status', '1' )->count();
            $productCount = Product::count();
            $orderCount = Order::count();
            // $offerCount = VendorOffers::where( 'vendor_id', Auth::user()->id )->count();

            return view( 'pages.dashboard', compact( 'categoryCount', 'subcategoryCount', 'productCount', 'orderCount' ) );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }
}
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ColorShadeController;
use App\Http\Controllers\consultationController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\HotDealsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PainterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::post('/login',[LoginController::class,'login']);
});



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index']);

    Route::post('/logout',[LoginController::class,'logout']);

    // CATEGORY
    Route::GET('/category/view',[CategoryController::class,'index']);
    Route::POST('/category/add',[CategoryController::class,'addcategory']);
    Route::POST('/category/update/{id}',[CategoryController::class,'update']);
    Route::POST('/category/delete/{id}',[CategoryController::class,'destroy']);
    Route::GET('/categories/data', [CategoryController::class, 'getCategories'])->name('categories.data');
    Route::POST('/category/fetchallcategory', [CategoryController::class, 'fetchallCategory']);

    //SUBCATEGORY 
    Route::GET('/subcategory/view',[SubCategoryController::class,'index']);
    Route::POST('/subcategory/add',[SubCategoryController::class,'addsubcategory']);
    Route::POST('/subcategory/edit',[SubCategoryController::class,'editsubcategory']);
    Route::POST('/subcategory/delete',[SubCategoryController::class,'deleteSubCategory']);
    Route::POST('/subcategory/fetchallsubcategory', [SubCategoryController::class, 'fetchallSubCategory']);

    // PRODUCT 
    Route::GET('/product/view',[ProductController::class,'index']);
    Route::GET('/product/addview',[ProductController::class,'addview']);
    Route::GET('/product/fetchsubcategory/{id}',[ProductController::class,'fetchsubcategory']);
    Route::POST('/product/store',[ProductController::class,'storeproduct']);
    Route::POST('/products/fetchallproducts',[ProductController::class,'fetchallProduct']);
    Route::GET('/products/editproduct/{id}',[ProductController::class,'editprodview']);

    // BANNER
    Route::GET('/banner/view',[BannerController::class,'index']);
    Route::GET('/product/addview',[ProductController::class,'addview']);
    Route::GET('/product/fetchsubcategory/{id}',[ProductController::class,'fetchsubcategory']);
    Route::POST('/product/store',[ProductController::class,'storeproduct']);
    Route::POST('/product/delete',[ProductController::class,'destroyproduct']);

    Route::GET('/consulting/view',[consultationController::class,'index']);
    Route::GET('/painter-booking/view',[PainterController::class,'index']);

    // COLORSHADE
    Route::GET('/colorshade/view',[ColorShadeController::class,'index']);
    Route::POST('/colorfamily/store',[ColorShadeController::class,'storeColorFamily']);
    Route::POST('/colorfamily/fetchcolorcodes',[ColorShadeController::class,'fetchtotalcolorcodes']);

    // VENDORS
    Route::GET('/vendor/view',[VendorController::class,'index']);
    Route::GET('/vendor/addview',[VendorController::class,'addview']);
    Route::GET('/vendor/orders',[VendorController::class,'vendororders']);
    Route::GET('/vendor/offers',[VendorController::class,'vendoroffers']);
    Route::POST('/vendor/store',[VendorController::class,'storevendor']);
    Route::GET('/vendor/productstock',[VendorController::class,'vendorStockView']);
    Route::POST('/vendor/fetchproductstock',[VendorController::class,'fetchproductstock']);
    Route::POST('/vendor/editprodstock',[VendorController::class,'editprodstock']);
    Route::POST('/vendor/addprodstock',[VendorController::class,'addprodstock']);
    Route::POST('/vendor/fetchorders',[VendorController::class,'fetchorders']);
    Route::POST('/vendor/fetchoffers',[VendorController::class,'fetchoffers']);
    Route::POST('/vendor/fetchproddetail',[VendorController::class,'fetchproductdetail']);
    Route::POST('/vendor/addoffer',[VendorController::class,'addvendoroffer']);
    Route::POST('/vendor/editoffer',[VendorController::class,'editvendoroffer']);
    
    Route::POST('/vendors/fetchAllVendors',[VendorController::class,'fetchallvendors']);
    Route::GET('/vendor/editvendor/{id}',[VendorController::class,'editvendorview']);
    Route::POST('/vendor/update',[VendorController::class,'updatevendor']);

    // PAINTERS
    Route::GET('/painter/view',[PainterController::class,'painterlist']);
    Route::POST('/painter/fetchAllPainters',[PainterController::class,'fetchtotalPainters']);
    Route::POST('/painter/approvepainter',[PainterController::class,'approvepainter']);

    // CONTRACTORS
    Route::GET('/contractor/view',[ContractorController::class,'contractorlist']);
    Route::POST('/contractor/fetchAllContractors',[ContractorController::class,'fetchtotalContractors']);
    Route::POST('/contractor/approvecontractor',[ContractorController::class,'approvecontractor']);

    Route::GET('/painter/projectview',[PainterController::class,'viewprojects']);
    Route::POST('/painter/project/add',[PainterController::class,'painterprojectadd']);

    Route::GET('/hotdeals/view',[HotDealsController::class,'index']);
    Route::POST('/hotdeals/fetchallhotdeals',[HotDealsController::class,'fetchtotaldeals']);
    Route::POST('/hotdeals/proddetailsfetch',[HotDealsController::class,'proddetailsfetch']);
    Route::POST('/hotdeals/store',[HotDealsController::class,'hotdealstore']);
    Route::POST('/hotdeals/update',[HotDealsController::class,'hotdealupdate']);
    Route::POST('/hotdeals/delete',[HotDealsController::class,'hotdealdestroy']);

    // PAINTERS CATEGORY
    Route::GET('/painter/category/view',[PainterController::class,'paintercategoryview']);
    Route::POST('/painter/category/fetchallcategory',[PainterController::class,'fetchtotalpaintercategory']);
    Route::POST('/painter/category/store',[PainterController::class,'paintercategorystore']);
    Route::POST('/painter/category/update',[PainterController::class,'paintercategoryupdate']);
    Route::POST('/painter/category/delete',[PainterController::class,'paintercategorydestroy']);


    Route::GET('/order/view',[OrderController::class,'index']);
    Route::POST('/order/fetchallorder',[OrderController::class,'fetchallorder']);
    Route::POST('/order/fetchorderdetails',[OrderController::class,'fetchorderdetails']);

    Route::GET('/prod/update-unique-name',[ProductController::class,'updateUniqueName']);
});
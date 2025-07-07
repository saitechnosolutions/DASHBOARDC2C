<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductChildImage;
use App\Models\ProductColor;
use App\Models\ProductStock;
use App\Models\ProductVarient;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller {
    public function index( ProductDataTable $dataTable ) {
        try {
            return $dataTable->render( 'pages.product' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function addview() {
        try {
            $categories = Category::all();
            $subcategories = SubCategory::all();

            return view( 'pages.product_add', compact( 'categories', 'subcategories' ) );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    // FETCH SUBCATEGORY

    public function fetchsubcategory( $id ) {
        try {
            $subcategories = SubCategory::where( 'category_name', $id )->get();
            return response()->json( $subcategories );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    // STORE PRODUCT

    public function storeproduct( Request $request ) {
        try {
            // Validate request data
            $validated = $request->validate( [
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'product_name' => 'required',
                'product_description' => 'required',
                'brand_name' => 'required',
                'brand_material' => 'required',
                'brand_type' => 'required',
                'approval_days' => 'required|numeric',
                'product_specification' => 'required',
                'varient_name.*' => 'required',
                'product_quantity.*' => 'required|numeric',
                'unit_value.*' => 'required',
                'product_value.*' => 'required|numeric',
                'product_mrp_price.*' => 'required|numeric',
                'product_offer_price.*' => 'required|numeric',
                'low_stock.*' => 'required|numeric',
                'product_gst.*' => 'required|numeric',
                'product_image' => 'required|image|mimes:png,jpg,webp,jpeg',
                'product_image1.*' => 'nullable|image|mimes:png,jpg,webp,jpeg'
            ] );

            // Fetch category and subcategory names
            $category = Category::findOrFail( $request->category_id );
            $subcategory = SubCategory::findOrFail( $request->subcategory_id );

            $non_colored = $request->non_colored_prod_check ?? 0;
            $static_colored = $request->static_colored_prod_check ?? 0;

            $static_colors = $request->product_static_color;

            if ( $request->hasFile( 'product_image' ) ) {
                $file = $request->file( 'product_image' );
                $extension = $file->getClientOriginalExtension();
                $imagePath = time() . 'b' . '.' . $extension;
                $file->move( 'uploads/products', $imagePath );
            }

            // Store main product image
            // $imagePath = $request->file( 'product_image' )->store( 'product_images', 'public' );

            // Create Product entry
            $product = Product::create( [
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'product_image' => $imagePath,
                'product_specification' => $request->product_specification,
                'brand_name' => $request->brand_name,
                'brand_material' => $request->brand_material,
                'brand_type' => $request->brand_type,
                'approval_days' => $request->approval_days,
                'cate_name' => $category->category_name,
                'subcate_name' => $subcategory->subcategory_name,
                'is_colored_product'=> $non_colored,
                'is_static_color'=>$static_colored,
            ] );

            foreach($static_colors as $static_color){
                ProductColor::create([
                    'product_id'=>$product->id,
                    'colorname'=>$static_color,
                ]);
            }

            // Loop through variants
            foreach ( $request->varient_name as $key => $variantName ) {
                // Store variant image if provided
                $variantImagePath = null;
                if ( !empty( $request->Varient_image[ $key ] ) && $request->Varient_image[ $key ]->isFile() ) {
                    $variantImagePath = $request->Varient_image[ $key ]->store( 'variant_images', 'public' );
                }

                // Create Product Variant entry
                $variant = ProductVarient::create( [
                    'categoryid' => $product->category_id,
                    'subcategoryid' => $product->subcategory_id,
                    'product_id' => $product->id,
                    'varient_name' => $variantName,
                    'varient' => $request->unit_value[ $key ],
                    'varient_img' => $variantImagePath,
                    'value' => $request->product_value[ $key ],
                    'offer_price' => $request->product_offer_price[ $key ],
                    'mrp_price' => $request->product_mrp_price[ $key ],
                    'product_qty' => $request->product_quantity[ $key ],
                    'low_stock' => $request->low_stock[ $key ],
                    'hot_deals' => $request->hot_deals[ $key ] ?? 0,
                    'Popular_products' => $request->popular_prod[ $key ] ?? 0,
                    'product_gst' => $request->product_gst[ $key ] ?? 0,
                    'color_value'=>$request->product_static_color[$key],
                ] );

                // Create stock entry
                ProductStock::create( [
                    'productid' => $product->id,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'pro_ver_id' => $variant->id,
                    'productname' => $request->product_name,
                    'overallstock' => $request->product_quantity[ $key ],
                    'availablestock' => $request->product_quantity[ $key ],
                    'salestock' => 0,
                    'low_stocks' => $request->low_stock[ $key ],
                    'last_stockupdate_date' => now()
                ] );
                
                if ( $request->hasFile( 'product_image1' ) ) {
                    foreach ( $request->file( 'product_image1' ) as $image ) {
                        // $imagePath = $image->store( 'product_images1', 'public' );
                        $file = $image;
                        $extension = $file->getClientOriginalExtension();
                        $imagePath = time() . 'b' . '.' . $extension;
                        $file->move( 'uploads/products', $imagePath );
                        ProductChildImage::create( [
                            'product_id' => $product->id,
                            'variant_id'=> $variant->id,
                            'product_child_image' => $imagePath
                        ] );
                    }
                }
            }

            // Store additional product images
            

            // Retrieve updated product list
            $products = Product::all();

            return response()->json( [
                'message' => 'Product Added Successfully',
                'products' => $products
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'message' => 'Error processing the request',
                'error' => $th->getMessage()
            ], 500 );
        }
    }

    public function fetchallProduct(Request $request)
    {
        $query = Product::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('categoryname', function ($data) {
                return $data->cate_name ? $data->cate_name : '-';
            })
            ->addColumn('subcategoryname', function ($data) {
                return $data->subcate_name ? $data->subcate_name : '-';
            })
            ->addColumn('productname', function ($data) {
                return $data->product_name ? $data->product_name : '-';
            })
            ->addColumn('brand', function ($data) {
                return $data->brand_name ? $data->brand_name : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                    <a class="btn btn-sm btn-primary"  
                        href="/products/editproduct/' . $data->id . '" >
                        Edit
                    </a>

                    <button class="btn btn-sm btn-danger delete-prod-btn"  
                        data-id="' . $data->id . '" >
                        Delete
                    </button>
        
                ';
            })            
            ->toJson();
    }

    public function editprodview($id){
        try {
            $categories = Category::all();
            $subcategories = SubCategory::all();
            $productDetails = Product::find($id);
            return view('pages.editproduct',compact('categories','productDetails','subcategories'));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function updateProduct(Request $request){
        try {
            $validated = $request->validate( [
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'product_name' => 'required',
                'product_description' => 'required',
                'brand_name' => 'required',
                'brand_material' => 'required',
                'brand_type' => 'required',
                'approval_days' => 'required|numeric',
                'product_specification' => 'required',
                'varient_name.*' => 'required',
                'product_quantity.*' => 'required|numeric',
                'unit_value.*' => 'required',
                'product_value.*' => 'required|numeric',
                'product_mrp_price.*' => 'required|numeric',
                'product_offer_price.*' => 'required|numeric',
                'low_stock.*' => 'required|numeric',
                'product_gst.*' => 'required|numeric',
                'product_image' => 'required|image|mimes:png,jpg,webp,jpeg',
                'product_image1.*' => 'nullable|image|mimes:png,jpg,webp,jpeg'
            ] );

            
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function destroyproduct(Request $request){
        try {
            $prodid = $request->prodid;

            $existingproduct = Product::find($prodid);
            $productVarients = ProductVarient::where('product_id',$prodid)->delete();
            $productStocks = ProductStock::where('productid',$prodid)->delete();

            $existingproduct->delete();

            return response()->json([
                'status' => '200',
                'message' => 'Product Deleted Successfully',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function updateUniqueName(){
        try {
            $products = Product::all();

            foreach($products as $prod){
                $prod_unique_name = strtolower(
                    preg_replace('/[^a-zA-Z0-9\s]/', '', $prod->product_name) // Remove special chars
                );
                
                $prod_unique_name = str_replace(' ', '-', $prod_unique_name); 

                $prod->update([
                    'prod_unique_name'=>$prod_unique_name, 
                ]);
            }

            return response()->json([
                'status'=>'200',
                'message'=>'unique Name Updated'
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

}
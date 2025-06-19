<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductChildImage;
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

    // public function storeproduct( Request $request ) {
    //     try {

    //         dd( $request );

    //         $validated = $request->validate( [
    //             'category_id' => 'required',
    //             'subcategory_id' => 'required',
    //             'product_name' => 'required',
    //             // 'product_quantity.*' => 'required',
    //             // 'product_mrp_price' => 'required',
    //             // 'product_offer_price' => 'required',
    //             'product_specification' => 'required',
    //             'product_image' => 'required|mimes:png,jpg,webp,jpeg',
    //             'product_description' => 'required',
    //             'brand_name'=>'required',
    //             'brand_material'=>'required',
    //             'brand_type'=>'required',
    //             'approval_days'=>'required',
    //             // 'unit_value' => 'required',
    //             // 'product_value' => 'required',
    // ] );

    //         $subcate = $request->subcategory_id;
    //         $subcatedisplay = SubCategory::where( 'id', $subcate )->first();
    //         $displayname = $subcatedisplay->subcategory_name;

    //         $cate = $request->category_id;
    //         $catedisplay = Category::where( 'id', $cate )->first();
    //         $catedisplayname = $catedisplay->category_name;

    //         $sizecheck = $request->size_check;

    //         $productName = $request->product_name;
    //         $productQuantity = $request->product_quantity;
    //         $productMrpPrice = $request->product_mrp_price;
    //         $productOfferPrice = $request->product_offer_price;
    //         $productSpec = $request->product_specification;
    //         $productImage = $request->product_image;
    //         $productdesc = $request->product_description;
    //         $productunit = $request->unit_value;
    //         $brandName = $request->brand_name;
    //         $brandMaterial = $request->brand_material;
    //         $brandType = $request->brand_type;
    //         $approvalDays = $request->approval_days;

    //         if ( $request->hasFile( 'product_image' ) ) {
    //             $productImage = $request->file( 'product_image' );
    //             $path =  $productImage->store( 'product_images', 'public' );
    //             $product = Product::create( [
    //                 'category_id'=>$cate,
    //                 'subcategory_id'=>$subcate,
    //                 'product_name'=>$productName,
    //                 'product_quantity'=>$productQuantity,
    //                 'product_mrp_price'=>$productMrpPrice,
    //                 'product_regular_price'=>$productOfferPrice,
    //                 'product_desc'=>$productdesc,
    //                 'product_image' => $path,
    //                 'product_spec'=>$productSpec,
    //                 'product_brand_name'=>$brandName,
    //                 'product_brand_material'=>$brandMaterial,
    //                 'product_brand_type'=>$brandType,
    //                 'product_approval_days'=>$approvalDays,
    //                 'product_unit_value'=>$productunit,
    //                 'product_cate_name'=>$catedisplayname,
    //                 'product_subcate_name'=>$displayname,
    //                 'product_size_value'=>$sizecheck
    // ] );
    //             $imageArray = $request->product_image1;
    //             $afterRemoval = [];
    //             $thumpArray = $request->product_image_count;
    //             // dd( $thumpArray );
    //             // $product = Product::create( [ ...$validated, 'cate_name'=>$catedisplayname, 'subcate_name'=>$displayname ] );

    //             foreach ( $request->Varient_image as $key => $productCode ) {

    //                 if ( count( $afterRemoval ) != 0 ) {
    //                     $tempImageArray = $afterRemoval;
    //                 }

    //                 if ( $productCode->isFile() ) {
    //                     // $varientImage = $request->file( 'Varient_image' );
    //                     $varientImage = $productCode;
    //                     // dd( $varientImage );
    //                     $vpath =  $varientImage->store( 'varient_images', 'public' );
    //                 }

    //                 $createdProduct =  ProductVarient::create( [
    //                     'category_id' =>$product->category_id,
    //                     'subcategory_id'=>$product->subcategory_id,
    //                     'product_id' => $product->id,
    //                     'varient' => $request->unit_value[ $key ],
    //                     'varient_img'=> $vpath,
    //                     // 'varient_name'=>$request->varient_name,
    //                     'varient_name'=>$request->varient_name[ $key ],
    //                     'value' => $request->product_value[ $key ],
    //                     'offer_price' => $request->product_offer_price[ $key ],
    //                     'mrp_price' => $request->product_mrp_price[ $key ],
    //                     'product_qty' => $request->product_quantity[ $key ],
    //                     'low_stock'=> $request->low_stock[ $key ],
    //                     'hot_deals'=> $request->hot_deals[ $key ] ?? 0,
    //                     'Popular_products'=> $request->popular_prod[ $key ] ?? 0,
    //                     'product_gst'=>$request->product_gst[ $key ] ?? 0,
    //                     'size_value'=>$sizecheck,
    // ] );

    //                 ProductStock::create( [
    //                     'product_id' => $product->id,
    //                     'category_id' =>  $cate,
    //                     'subcategory_id'=> $subcate,
    //                     'varient_id'=>$createdProduct->id,
    //                     'productname' => $productName,
    //                     'overallstock' =>  $request->product_quantity[ $key ],
    //                     'availablestock' => $request->product_quantity[ $key ],
    //                     'salestock' => 0,
    //                     'low_stocks'=> $request->low_stock[ $key ],
    //                     'last_stockupdate_date' => date( 'Y-m-d' ),
    // ] );

    //                 foreach ( $request->product_image1 as $thumpkey => $img ) {
    //                     // dd( $request->product_image1 );
    //                     if ( $img->isFile() ) {
    //                         if ( count( $afterRemoval ) == 0 ) {
    //                             if ( $thumpArray[ $key ] > $thumpkey ) {
    //                                 $productImage = $img;
    //                                 $path =  $productImage->store( 'product_images1', 'public' );
    //                                 $product1 = ProductChildImage::create( [ 'product_id' => $product->id, 'product_child_image' => $path, 'varient_id' => $createdProduct->id ] );

    //                             }
    //                         } else {
    //                             if ( $thumpArray[ $key ] > $thumpkey ) {
    //                                 $productImage = $afterRemoval[ $thumpkey ];
    //                                 $path =  $productImage->store( 'product_images1', 'public' );
    //                                 $product1 = ProductChildImage::create( [ 'product_id' => $product->id, 'product_child_image' => $path, 'varient_id' => $createdProduct->id ] );

    //                             }
    //                         }

    //                     }
    //                 }

    //                 $afterRemoval = array_slice( count( $afterRemoval ) != 0 ? $tempImageArray : $imageArray, $thumpArray[ $key ] );
    //                 // print_r( $afterRemoval );
    //                 // array_slice( $request->product_image1, 2 );

    //             }
    //             // dd( $request->product_image1 );

    //             // foreach ( $request->product_image1 as $imgkey => $img ) {

    //             //         if ( $img->isFile() ) {
    //             //             $productImage = $img;
    //             //             $path =  $productImage->store( 'product_images1', 'public' );
    //             //             $product1 = ProductChildImage::create( [ 'product_id' => $product->id, 'product_child_image' => $path, 'variant_id' => $createdProduct->id ] );
    //             //         }
    //             // }

    //             // foreach ( $request->product_image1 as $key => $img ) {

    //             //     if ( $img->isFile() ) {
    //             //         $productImage = $img;
    //             //         $path =  $productImage->store( 'product_images1', 'public' );
    //             //         $product1 = ProductChildImage::create( [ 'product_id' => $product->id, 'product_child_image' => $path, 'variant_id' => $createdProduct->id ] );
    //             //     }
    //             // }
    //             $products =  Product::all();

    //             return response()->json( [
    //                 'message' => 'Product Added Successfully',
    //                 'products' => $products
    // ] );
    //         }
    //     } catch ( \Throwable $th ) {
    //         Log::error( $th );
    //     }
    // }

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
                'subcate_name' => $subcategory->subcategory_name
            ] );

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
                    'product_gst' => $request->product_gst[ $key ] ?? 0
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

}
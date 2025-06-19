<?php

namespace App\Http\Controllers;

use App\DataTables\VendorDataTable;
use App\Mail\VendorCreationMail;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorOffers;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller {
    public function index( VendorDataTable $datatable ) {
        try {
            return $datatable->render( 'pages.vendors' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return redirect()->back();
        }
    }

    public function addview() {
        try {
            return view( 'pages.vendor_add' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return redirect()->back();
        }
    }

    public function storevendor( Request $request ) {
        try {
            $vendorName = $request->vendorName;
            $vendoremail = $request->vendoremail;
            $vendorContactName = $request->vendorContactName;
            $vendorContactNumber = $request->vendorContactNumber;
            $vendorBusinessType = $request->vendorBusinessType;
            $vendorgst = $request->vendorgst;
            $vendorAddress = $request->vendorAddress;
            $vendorState = $request->vendorState;
            $vendorDistrict = $request->vendorDistrict;
            $vendorPincode = $request->vendorPincode;
            $vendorBankName = $request->vendorBankName;
            $vendorAccountHolderName = $request->vendorAccountHolderName;
            $vendorAccountNumber = $request->vendorAccountNumber;
            $vendorifsc = $request->vendorifsc;

            Vendor::create( [
                'vendor_name'=> $vendorName,
                'vendor_email'=>$vendoremail,
                'contact_name'=>$vendorContactName,
                'contact_phone'=>$vendorContactNumber,
                'business_type'=>$vendorBusinessType,
                'gst_number'=>$vendorgst,
                'vendor_address'=>$vendorAddress,
                'vendor_state'=>$vendorState,
                'vendor_district'=>$vendorDistrict,
                'vendor_pincode'=>$vendorPincode,
                'vendor_bank_name'=>$vendorBankName,
                'vendor_account_name'=>$vendorAccountHolderName,
                'vendor_account_number'=>$vendorAccountNumber,
                'vendor_ifsc_number'=>$vendorifsc,
            ] );

            $defaultPass = '2025';

            User::create( [
                'name' => $vendorName,
                'email' => $vendoremail,
                'password' => bcrypt( $defaultPass ),
                'role'=>'Vendor',
            ] );

            $data = [
                'vendorname'=>$vendorName,
                'email'=>$vendoremail,
                'password'=>'2025',
            ];

            // dd( $data );

            Mail::to( 'allwyns.sts@gmail.com' )->send( new VendorCreationMail( $data[ 'vendorname' ], $data[ 'email' ], $data[ 'password' ] ) );

            return response()->json( [
                'status'=>'200',
                'message'=>'Vendor Added Successfully',
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to store Vendor'
            ] );
        }
    }

    public function vendorStockView() {
        try {
            $products = Product::all();
            return view( 'vendorpages.productstock',compact('products') );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to open page'
            ] );
        }
    }

    public function fetchproductstock(Request $request){
        try {
            $query = ProductStock::where('vendor_id', Auth::user()->id)
            ->with(['product:id,product_name', 'category:id,category_name'])
            ->orderBy('id', 'desc');

            return datatables()->eloquent($query)
                ->addColumn('sno', function ($vendor) {
                    static $rowNumber = 0;
                    $rowNumber++;
                    $start = request()->input('start', 0);
                    return $start + $rowNumber;
                })
                // ->addColumn('category', function ($vendor) {
                //     return $vendor->category ? $vendor->category->category_name : '-';
                // })
                ->addColumn('productname', function ($vendor) {
                    return $vendor ? $vendor->product->product_name : '-';
                })
                ->addColumn('availablestock', function ($vendor) {
                    return $vendor ? $vendor->availablestock : '-';
                })
                ->addColumn('salestock', function ($vendor) {
                    return $vendor ? $vendor->salestock: '-';
                })
                ->addColumn('action', function ($vendor) {
                    return '
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background:none;border:none;">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item change-status-btn" href="#" 
                                    data-id="'.$vendor->id.'"
                                    data-vendorid="'.$vendor->vendor_id.'"
                                    data-cateid="'.$vendor->category_id.'" 
                                    data-prodid="'.$vendor->product_id.'" 
                                    data-availstock="'.$vendor->availablestock.'" 
                                    data-salestock="'.$vendor->salestock.'" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#staticBackdrop">
                                    Edit
                                    </a>
                                </li>
                            </ul>
                        </div>
                        ';
                })
                ->rawColumns(['category','action'])
                ->toJson();
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to open page'
            ] );
        }
    }

    public function editprodstock(Request $request){
        try {
            $product = $request->product;
            $availstock = $request->availstock;
            $saleStock = $request->saleStock;
            $prodStockid = $request->prodStockid;
            $vendor_id = $request->vendor_id;

            $prod_stock = ProductStock::find($prodStockid);

            $prod_stock->update([
                'product_id' => $product,
                'availablestock'=> $availstock,
                'salestock'=>$saleStock,
            ]);

            return response()->json( [
                'status'=>'200',
                'message'=>'Stock updated Successfully',
            ] );
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to edit stock'
            ] );
        }
    }

    public function addprodstock(Request $request){
        try {
            $product = $request->product;
            $availstock = $request->availstock;
            $saleStock = $request->saleStock;
            $vendor_id = $request->vendor_id;

            ProductStock::create([
                'vendor_id'=>$vendor_id,
                'product_id'=>$product,
                'availablestock'=> $availstock,
                'salestock'=>$saleStock,
            ]);
            
            return response()->json( [
                'status'=>'200',
                'message'=>'Stock updated Successfully',
            ] );
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to edit stock'
            ] );
        }
    }

    public function vendororders(){
        try {
            return view( 'vendorpages.orders' );
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to open orders page'
            ] );
        }
    }


    public function fetchorders(Request $request){
        try {
            $query = ProductStock::where('vendor_id', '1')
            ->with(['product:id,product_name', 'category:id,category_name'])
            ->orderBy('id', 'desc');

            return datatables()->eloquent($query)
                ->addColumn('sno', function ($vendor) {
                    static $rowNumber = 0;
                    $rowNumber++;
                    $start = request()->input('start', 0);
                    return $start + $rowNumber;
                })
                ->addColumn('category', function ($vendor) {
                    return $vendor->category ? $vendor->category->category_name : '-';
                })
                ->addColumn('productname', function ($vendor) {
                    return $vendor ? $vendor->product->product_name : '-';
                })
                ->addColumn('availablestock', function ($vendor) {
                    return $vendor ? $vendor->availablestock : '-';
                })
                ->addColumn('salestock', function ($vendor) {
                    return $vendor ? $vendor->salestock: '-';
                })
                ->addColumn('action', function ($vendor) {
                    return '
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background:none;border:none;">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item change-status-btn" href="#" 
                                    data-id="'.$vendor->id.'"
                                    data-vendorid="'.$vendor->vendor_id.'"
                                    data-cateid="'.$vendor->category_id.'" 
                                    data-prodid="'.$vendor->product_id.'" 
                                    data-availstock="'.$vendor->availablestock.'" 
                                    data-salestock="'.$vendor->salestock.'" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#staticBackdrop">
                                    Edit
                                    </a>
                                </li>
                            </ul>
                        </div>
                        ';
                })
                ->rawColumns(['category','action'])
                ->toJson();
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to open page'
            ] );
        }
    }

    public function vendoroffers(){
        try {
            $products = Product::all();
            return view( 'vendorpages.offers',compact('products') );
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to open orders page'
            ] );
        }
    }

    public function fetchoffers(Request $request){
        try {
            $query = VendorOffers::where('vendor_id',Auth::user()->id)
            ->where('offer_status', '1')
            ->with(['product:id,product_name'])
            ->orderBy('id', 'desc');

            return datatables()->eloquent($query)
                ->addColumn('sno', function ($vendor) {
                    static $rowNumber = 0;
                    $rowNumber++;
                    $start = request()->input('start', 0);
                    return $start + $rowNumber;
                })
                ->addColumn('productname', function ($vendor) {
                    return $vendor->product ? $vendor->product->product_name : '-';
                })
                ->addColumn('productprice', function ($vendor) {
                    return $vendor ? $vendor->product_price : '-';
                })
                ->addColumn('offerprice', function ($vendor) {
                    return $vendor ? $vendor->offer_price : '-';
                })
                ->addColumn('enddate', function ($vendor) {
                    return $vendor ? $vendor->offer_end_date: '-';
                })
                ->addColumn('action', function ($vendor) {
                    return '
                        <div class="dropdown">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background:none;border:none;">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item edit-vendor-offer-btn" href="#" 
                                    data-offerid="'.$vendor->id.'"
                                    data-vendorid="'.$vendor->vendor_id.'"
                                    data-productid="'.$vendor->product_id.'"
                                    data-productprice="'.$vendor->product_price.'"
                                    data-offerprice="'.$vendor->offer_price.'"
                                    data-offerendDate="'.$vendor->offer_end_date.'"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#staticBackdrop">
                                    Edit
                                    </a>
                                </li>
                            </ul>
                        </div>
                        ';
                })
                ->rawColumns(['category','action'])
                ->toJson();
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to open page'
            ] );
        }
    }

    public function fetchproductdetail(Request $request){
        try {
            $prodid = $request->product;

            $productdetail = Product::find($prodid);

            return response()->json( [
                'status'=>'200',
                'message'=>'Details Fetched Successfully',
                'data'=>$productdetail,
            ] );
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable fetch product details'
            ] );
        }
    }


    public function addvendoroffer(Request $request){
        try {
            $prodid = $request->product;
            $productPrice = $request->productPrice;
            $offerprice = $request->offerprice;
            $offerendDate = $request->offerendDate;
            $vendorid = $request->vendorid;

            VendorOffers::create([
                'vendor_id'=>$vendorid,
                'product_id'=>$prodid,
                'product_price'=>$productPrice,
                'offer_price'=>$offerprice,
                'offer_end_date'=>$offerendDate,
            ]);
            

            return response()->json( [
                'status'=>'200',
                'message'=>'Offer Added SuccessFully',                
            ] );
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable add offer'
            ] );
        }
    }

    public function editvendoroffer(Request $request){
        try {
            $prodid = $request->product;
            $productPrice = $request->productPrice;
            $offerprice = $request->offerprice;
            $offerendDate = $request->offerendDate;
            $vendorid = $request->vendorid;
            $offerid = $request->offerid;

            $vendoroffer = VendorOffers::find($offerid);

            $vendoroffer->update([
                'vendor_id'=>$vendorid,
                'product_id'=>$prodid,
                'product_price'=>$productPrice,
                'offer_price'=>$offerprice,
                'offer_end_date'=>$offerendDate,
            ]);
            
            return response()->json( [
                'status'=>'200',
                'message'=>'Offer Updated SuccessFully',                
            ] );
        } catch (\Throwable $th) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable Edit offer'
            ] );
        }
    }

    public function fetchallvendors(Request $request)
    {
        $query = Vendor::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('vendorname', function ($data) {
                return $data->vendor_name ? $data->vendor_name : '-';
            })
            ->addColumn('vendoremail', function ($data) {
                return $data->vendor_email ? $data->vendor_email : '-';
            })
            ->addColumn('contactname', function ($data) {
                return $data->contact_name ? $data->contact_name : '-';
            })
            ->addColumn('contactphone', function ($data) {
                return $data->contact_phone ? $data->contact_phone : '-';
            })
            ->addColumn('businesstype', function ($data) {
                return $data->business_type ? $data->business_type : '-';
            })
            ->addColumn('gst', function ($data) {
                return $data->gst_number ? $data->gst_number : '-';
            })
            ->addColumn('address', function ($data) {
                return $data->vendor_address ? $data->vendor_address : '-';
            })
            ->addColumn('state', function ($data) {
                return $data->vendor_state ? $data->vendor_state : '-';
            })
            ->addColumn('district', function ($data) {
                return $data->vendor_district ? $data->vendor_district : '-';
            })
            ->addColumn('pincode', function ($data) {
                return $data->vendor_pincode ? $data->vendor_pincode : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                <a href="/vendor/editvendor/' . $data->id . '" class="btn btn-sm btn-primary">Edit</a>';
            })            
            ->toJson();
    }

    public function editvendorview($id){
        try {
            $vendorDetails = Vendor::find($id);
            $products = Product::all();
            return view('pages.vendor_edit',compact('vendorDetails','products'));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function updatevendor( Request $request ) {
        try {
            $vendorName = $request->vendorName;
            $vendoremail = $request->vendoremail;
            $vendorContactName = $request->vendorContactName;
            $vendorContactNumber = $request->vendorContactNumber;
            $vendorBusinessType = $request->vendorBusinessType;
            $vendorgst = $request->vendorgst;
            $vendorAddress = $request->vendorAddress;
            $vendorState = $request->vendorState;
            $vendorDistrict = $request->vendorDistrict;
            $vendorPincode = $request->vendorPincode;
            $vendorBankName = $request->vendorBankName;
            $vendorAccountHolderName = $request->vendorAccountHolderName;
            $vendorAccountNumber = $request->vendorAccountNumber;
            $vendorifsc = $request->vendorifsc;
            $vendorprods = $request->vendorproducts;
            $vendor_id = $request->vendorid;

            foreach($vendorprods as $prod){
                VendorProduct::create([
                    'vendor_id'=>$vendor_id,
                    'product_id'=>$prod,
                    'product_pincode'=>$vendorPincode,
                ]);
            }

            $existingVendor = Vendor::find($vendor_id);

            $existingVendor->update([
                'vendor_name'=> $vendorName,
                'vendor_email'=>$vendoremail,
                'contact_name'=>$vendorContactName,
                'contact_phone'=>$vendorContactNumber,
                'business_type'=>$vendorBusinessType,
                'gst_number'=>$vendorgst,
                'vendor_address'=>$vendorAddress,
                'vendor_state'=>$vendorState,
                'vendor_district'=>$vendorDistrict,
                'vendor_pincode'=>$vendorPincode,
                'vendor_bank_name'=>$vendorBankName,
                'vendor_account_name'=>$vendorAccountHolderName,
                'vendor_account_number'=>$vendorAccountNumber,
                'vendor_ifsc_number'=>$vendorifsc,
            ]);

            return response()->json( [
                'status'=>'200',
                'message'=>'Vendor Updated Successfully',
            ] );
            
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable to store Vendor'
            ] );
        }
    }

}
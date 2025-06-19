<?php

namespace App\Http\Controllers;

use App\Models\HotDeal;
use App\Models\ProductVarient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotDealsController extends Controller {
    public function index() {
        try {
            $prodVarients = ProductVarient::all();
            return view( 'pages.hotdealsindex',compact('prodVarients') );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchtotaldeals(Request $request)
    {
        $query = HotDeal::orderBy('id', 'desc');
        

        if ($request->input('executive') !== null) {
            $query->where('user_id', $request->input('executive'));
        }

        if ($request->input('lead_id') !== null) {
            $query->where('lead_id', $request->input('lead_id'));
        }

        if ($request->input('type') !== null) {
            $query->where('treatment_cate', $request->input('type'));
        }

        if ($request->input('method') !== null) {
            $query->where('treatment_type', $request->input('method'));
        }

        if ($request->input('branch') !== null) {
            $query->where('preferred_branch', $request->input('branch'));
        }

        if ($request->input('state') !== null) {
            $query->where('state', $request->input('state'));
        }

        if ($request->input('city') !== null) {
            $query->where('city', $request->input('city'));
        }

        if ($request->input('fdate') && $request->input('tdate')) {
            $query->whereDate('created_at', '>=', $request->input('fdate'))
                ->whereDate('created_at', '<=', $request->input('tdate'));
        }

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('productname', function ($data) {
                return $data->product_name ? $data->product_name : '-';
            })
            ->addColumn('offervalue', function ($data) {
                return $data->offer_value ? $data->offer_value : '-';
            })
            ->addColumn('offerprice', function ($data) {
                return $data->offer_price ? $data->offer_price : '-';
            })
            ->addColumn('offerstartdate', function ($data) {
                return $data->deal_start_date ? $data->deal_start_date : '-';
            })
            ->addColumn('offerenddate', function ($data) {
                return $data->deal_end_date ? $data->deal_end_date : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                    <button type="button" 
                            class="btn btn-sm btn-primary edit-hot-deal-btn" 
                            data-id="' . $data->id . '" 
                            data-varientid="' . $data->prod_variant_id . '" 
                            data-offervalue="' . $data->offer_value . '" 
                            data-offerprice="' . $data->offer_price . '" 
                            data-offerstartdate="' . $data->deal_start_date . '" 
                            data-offerenddate="' . $data->deal_end_date . '" 
                            data-actualprice="' . $data->prod_actual_price . '" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editsubcategoryModal"
                            >
                        Edit
                    </button>
                    
                    <button type="button" 
                            class="btn btn-sm btn-danger delete-hot-deal-btn" 
                            data-id="' . $data->id . '">
                        Delete
                    </button>';
            })            
            ->toJson();
    }

    public function proddetailsfetch(Request $request){
        try {
            $varient_id = $request->varientid;

            $prodDetails = ProductVarient::find($varient_id);

            return response()->json([
                'status'=>'200',
                'message'=>'Product Details Fetched Successfully',
                'productdetails'=>$prodDetails,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function hotdealstore(Request $request){
        try {
            $varientid = $request->varientid;
            $offervalue = $request->offerpercentage;
            $offerprice = $request->offerprice;
            $offerStartdate = $request->offerstartdate;
            $offerenddate = $request->offerenddate;
            $actualprice = $request->offeractualprice;

            $varientDetails = ProductVarient::find($varientid);
            
            HotDeal::create([
                'product_id'=> $varientDetails->product_id,
                'prod_variant_id'=> $varientid,
                'product_name'=> $varientDetails->varient_name,
                'offer_value'=> $offervalue,
                'offer_price'=> $offerprice,
                'prod_actual_price'=> $actualprice,
                'deal_start_date'=> $offerStartdate,
                'deal_end_date'=> $offerenddate,
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Deal Stored Successfully',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function hotdealupdate(Request $request){
        try {
            $varientid = $request->varientid;
            $offervalue = $request->offerpercentage;
            $offerprice = $request->offerprice;
            $offerStartdate = $request->offerstartdate;
            $offerenddate = $request->offerenddate;
            $actualprice = $request->offeractualprice;
            $dealid = $request->dealid;

            $varientDetails = ProductVarient::find($varientid);
            $existingDeal = HotDeal::find($dealid);

            $existingDeal->update([
                'product_id'=> $varientDetails->product_id,
                'prod_variant_id'=> $varientid,
                'product_name'=> $varientDetails->varient_name,
                'offer_value'=> $offervalue,
                'offer_price'=> $offerprice,
                'prod_actual_price'=> $actualprice,
                'deal_start_date'=> $offerStartdate,
                'deal_end_date'=> $offerenddate,
            ]);
            
            return response()->json([
                'status'=>'200',
                'message'=>'Deal Updated Successfully',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function hotdealdestroy(Request $request){
        try {
            $dealid = $request->dealid;
            $existingDeal = HotDeal::find($dealid);
            $existingDeal->delete();

            return response()->json([
                'status'=>'200',
                'message'=>'Deal Deleted Successfully',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
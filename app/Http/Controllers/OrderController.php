<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller {
    public function index() {
        try {
            if ( Auth::user()->role == 'ADMIN' ) {
                $orders = Order::all();
            } else {
                $orders = Order::where( 'vendor_id', Auth::user()->id );
            }
            return view( 'pages.orders', compact( 'orders' ) );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchallorder(Request $request)
    {
        $query = Order::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('orderid', function ($data) {
                return $data->order_id ? $data->order_id : '-';
            })
            ->addColumn('customername', function ($data) {
                return $data->customer ? $data->customer->name : '-';
            })
            ->addColumn('ordervalue', function ($data) {
                return $data->total_amount ? $data->total_amount : '-';
            })
            ->addColumn('orderdate', function ($data) {
                return $data->date_ordered_on ? $data->date_ordered_on : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                    <button class="btn btn-sm btn-primary view-order-details-btn"  
                        data-id="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        View
                    </button>
                ';
            })            
            ->toJson();
    }

    public function fetchorderdetails(Request $request){
        try {
            $order_id = $request->order_id;

            $orderDetails = ProductSlot::with('product')
                ->where('order_id', $order_id)
                ->get();

            return response()->json([
                'status'=>'200',
                'message'=>'order Details Fetched Successfully',
                'order_details'=>$orderDetails,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
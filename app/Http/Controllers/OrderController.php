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
            ->addColumn('orderstatus', function ($data) {
                // return $data->date_ordered_on ? $data->date_ordered_on : '-';
                if($data->delivery_status == 0){
                    return 'Pending';
                }elseif($data->delivery_status == 1){
                    return 'Packing';
                }elseif($data->delivery_status == 2){
                    return 'Dispatched';
                }elseif($data->delivery_status == 3){
                    return 'Out for Delivery';
                }elseif($data->delivery_status == 4){
                    return 'Delivered';
                }
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

    public function changeorderStatus(Request $request){
        try {
            $orderid = $request->orderId;
            $orderStat = $request->orderStat;
            $trackingNumber = $request->trackingnumber;

            if(!$trackingNumber){
                $existingOrder = Order::where('order_id',$orderid)->first();
                // $orderSlot = ProductSlot::where('order_id',$orderid)->get();
                $existingOrder->update([
                    'delivery_status'=>$orderStat, 
                ]);
            }else{
                
            }
            return response()->json([
                'status'=>'200',
                'message'=>'Status Updated SuccessFully' 
            ]);
            
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function fetchpendingorder(Request $request)
    {
        $query = Order::where('delivery_status', 0)
        ->orderBy('id', 'desc');

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
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        view
                    </button>
                    <button class="btn btn-sm btn-success mr-3 update-order-details-btn"  
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModalupdate">
                        Update
                    </button>
                ';
            }) 
            ->toJson();
    }

    public function fetchpackedorder(Request $request)
    {
        $query = Order::where('delivery_status', 1)
        ->orderBy('id', 'desc');

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
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        view
                    </button>
                    <button class="btn btn-sm btn-success mr-3 update-packedorder-details-btn"  
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModalPacked">
                        Update
                    </button>
                ';
            })            
            ->toJson();
    }
    
    public function fetchispatchedDorder(Request $request)
    {
        $query = Order::where('delivery_status', 2)
        ->orderBy('id', 'desc');

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
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        view
                    </button>
                    <button class="btn btn-sm btn-success mr-3 update-dispatchedorder-details-btn"  
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModalDispatched">
                        Update
                    </button>
                ';
            })            
            ->toJson();
    }
    
    public function fetchoutfordeliveryorder(Request $request)
    {
        $query = Order::where('delivery_status', 3)
        ->orderBy('id', 'desc');

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
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        view
                    </button>
                    <button class="btn btn-sm btn-success mr-3 update-outfordeliveryorder-details-btn"  
                        data-orderid="' . $data->order_id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModalOutfordelivery">
                        Update
                    </button>
                ';
            })            
            ->toJson();
    }
    
    public function fetchdeliveredorder(Request $request)
    {
        $query = Order::where('delivery_status', 4)
        ->orderBy('id', 'desc');

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
            ->addColumn('delivereddate', function ($data) {
                return $data->updated_at ? $data->updated_at : '-';
            })            
            ->toJson();
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\ColorFamily;
use App\Models\ColorShade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ColorShadeController extends Controller {
    public function index() {
        try {
            return view( 'pages.colorshade' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchtotalcolorcodes(Request $request)
    {
        $query = ColorShade::orderBy('id', 'desc');
        

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
            ->addColumn('colorfam', function ($data) {
                return $data->colorFamily ? $data->colorFamily->color_family_name : '-';
            })
            ->addColumn('colorcode', function ($data) {
                return $data ? $data->colorcode : '-';
            })
            ->toJson();
    }

    public function storeColorFamily(Request $request){
        try {
            $colorFamily = $request->colorfamily;
            $colorcodes = $request->color_codes;
            $colorbrands = $request->color_brands;
    
            $colorfamily = ColorFamily::create([
                'color_family_name'=> $colorFamily,
            ]);
    
            foreach($colorcodes as $index => $colorcode){
                ColorShade::create([
                    'color_fam_id' => $colorfamily->id,
                    'colorcode'    => $colorcode,
                    'brand_name'   => $colorbrands[$index] ?? null,
                ]);
            }
    
            return response()->json([
                'status'=>'200',
                'message'=>'Color Family Added' 
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => '500',
                'message' => 'Something went wrong'
            ], 500);
        }
    }
    
}
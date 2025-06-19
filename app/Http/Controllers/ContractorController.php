<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContractorController extends Controller {
    public function contractorlist() {
        try {
            return view( 'pages.contractorlist' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchtotalContractors(Request $request)
    {
        $query = Contractor::orderBy('id', 'desc');
        

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
            ->addColumn('contractorname', function ($data) {
                return $data->contractor_name ? $data->contractor_name : '-';
            })
            ->addColumn('contractoremail', function ($data) {
                return $data->contractor_email ? $data->contractor_email : '-';
            })
            ->addColumn('contractormobile', function ($data) {
                return $data->contractor_mobile ? $data->contractor_mobile : '-';
            })
            ->addColumn('contractorstate', function ($data) {
                return $data->contractor_state ? $data->contractor_state : '-';
            })
            ->addColumn('contractorcity', function ($data) {
                return $data->contractor_city ? $data->contractor_city : '-';
            })
            ->addColumn('contractoraddress', function ($data) {
                return $data->contractor_address ? $data->contractor_address : '-';
            })
            ->addColumn('contractorpincode', function ($data) {
                return $data->contractor_pincode ? $data->contractor_pincode : '-';
            })
            ->addColumn('contractorStatus', function ($data) {
                if($data->approval_status == 0){
                    return 'NOT VERIFIED';
                }else{
                    return 'VERIFIED';
                }
            })
            ->addColumn('action', function ($data) {
                return '
                    <button type="button" 
                            class="btn btn-sm btn-primary approve-contractor-btn" 
                            data-id="' . $data->id . '" 
                            data-bs-toggle="modal" 
                            data-bs-target="#viewPainterModal"
                            >
                        Edit
                    </button>';
            })            
            ->toJson();
    }

    public function approvecontractor(Request $request){
        try {
            $approval_stat = $request->approvalStat;
            $contractorId = $request->contractorId;

            $Contractor = Contractor::find($contractorId);
            
            $Contractor->update([
                'approval_status'=> $approval_stat,
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Contractor Approved SuccessFully',
            ]);
            
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }
}
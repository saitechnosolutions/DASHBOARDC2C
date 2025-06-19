<?php

namespace App\Http\Controllers;

use App\DataTables\PainterDataTable;
use App\Models\Painter;
use App\Models\PainterCategory;
use App\Models\PainterMaster;
use App\Models\PainterProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PainterController extends Controller {
    public function index( PainterDataTable $dataTable ) {
        try {
            return $dataTable->render( 'pages.painterbooking' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function painterlist() {
        try {
            $paintercategory = PainterCategory::all();
            return view( 'pages.painterlist','paintercategory' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchtotalPainters(Request $request)
    {
        $query = PainterMaster::orderBy('id', 'desc');
        

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
            ->addColumn('paintername', function ($data) {
                return $data->painter_name ? $data->painter_name : '-';
            })
            ->addColumn('painteremail', function ($data) {
                return $data->painter_email ? $data->painter_email : '-';
            })
            ->addColumn('paintermobile', function ($data) {
                return $data->painter_mobile ? $data->painter_mobile : '-';
            })
            ->addColumn('painterstate', function ($data) {
                return $data->painter_state ? $data->painter_state : '-';
            })
            ->addColumn('paintercity', function ($data) {
                return $data->painter_city ? $data->painter_city : '-';
            })
            ->addColumn('painteraddress', function ($data) {
                return $data->painter_address ? $data->painter_address : '-';
            })
            ->addColumn('painterpincode', function ($data) {
                return $data->painter_pincode ? $data->painter_pincode : '-';
            })
            ->addColumn('painterStatus', function ($data) {
                if($data->approval_status == 0){
                    return 'NOT VERIFIED';
                }else{
                    return 'VERIFIED';
                }
            })
            ->addColumn('action', function ($data) {
                return '
                    <button type="button" 
                            class="btn btn-sm btn-primary approve-painter-btn" 
                            data-id="' . $data->id . '" 
                            data-bs-toggle="modal" 
                            data-bs-target="#viewPainterModal"
                            >
                        Edit
                    </button>';
            })            
            ->toJson();
    }

    public function approvepainter(Request $request){
        try {
            $approval_stat = $request->approvalStat;
            $painter_id = $request->painterId;

            $painter = PainterMaster::find($painter_id);
            
            $painter->update([
                'approval_status'=> $approval_stat,
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Painter Approved SuccessFully',
            ]);
            
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }

    public function viewprojects(){
        try {
            $projects = PainterProjects::where('painter_id',Auth::user()->user_id )->get();
            return view('pages.painterprojectview',compact('projects'));
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }

    public function painterprojectadd(Request $request){
        try {

            $painter_id = $request->add_painter_user_id;

            if ( $request->hasFile( 'add_painter_project_image' ) ) {

                $file = $request->file( 'add_painter_project_image' );
                $extension = $file->getClientOriginalExtension();
                $filename = time() . 'b' . '.' . $extension;
                $file->move( 'uploads/projects', $filename );
            }

            PainterProjects::create([
                'painter_id'=>$painter_id,
                'painter_project_image'=>$filename,
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Project Added SuccessFully',
            ]);
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }


    // ========= PAINTER CATEGORY ========= //

    public function paintercategoryview(){
        try {
            return view( 'pages.paintercategory' );
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }

    public function fetchtotalpaintercategory(Request $request)
    {
        $query = PainterCategory::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('categoryname', function ($data) {
                return $data->painter_category_name ? $data->painter_category_name : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                    <button class="btn btn-sm btn-primary edit-painter-category-btn"  
                        data-id="' . $data->id . '" 
                        data-categoryname="' . e($data->painter_category_name) . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        Edit
                    </button>
            
                    <button class="btn btn-sm btn-danger delete-painter-category-btn"  
                        data-id="' . $data->id . '" >
                        Delete
                    </button>
                ';
            })            
            ->toJson();
    }

    public function paintercategorystore(Request $request){
        try {
            $categoryname = $request->categoryname;

            PainterCategory::create([
                'painter_category_name'=> $categoryname,
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Category Added SuccessFully',
            ]);
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }

    public function paintercategoryupdate(Request $request){
        try {
            $categoryname = $request->categoryname;
            $categoryid = $request->categoryid;

            $existingcategory = PainterCategory::find($categoryid);

            $existingcategory->update([
                'painter_category_name'=> $categoryname,
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Category Updated SuccessFully',
            ]);
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }

    public function paintercategorydestroy(Request $request){
        try {
            $categoryid = $request->categoryid;
            $existingcategory = PainterCategory::find($categoryid);

            $existingcategory->delete();

            return response()->json([
                'status'=>'200',
                'message'=>'Category Delete SuccessFully',
            ]);
        } catch (\Throwable $th) {
            Log::error( $th );
        }
    }
}
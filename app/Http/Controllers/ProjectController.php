<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectProd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller {
    public function index() {
        try {
            $products = Product::all();
            return view( 'pages.projects', compact('products') );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchallprojects(Request $request)
    {
        $query = Project::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('projecttitle', function ($data) {
                return $data->project_name ? $data->project_name : '-';
            })
            ->addColumn('projectprods', function ($data) {
                return $data->project_name ? $data->project_name : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                    <button class="btn btn-sm btn-primary view-order-details-btn"  
                        data-id="' . $data->id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        Edit
                    </button>
                ';
            })
            ->rawColumns(['action'])            
            ->toJson();
    }

    public function storeproject(Request $request){
        try {
            $projectTitle = $request->add_project_title;
            $projectProducts = $request->add_project_products;

            $project = Project::create([
                'project_name'=>$projectTitle, 
            ]);

            foreach($projectProducts as $product){
                ProjectProd::create([
                    'project_id'=> $project->id,
                    'product_id'=>$product
                ]);
            }

            return response()->json([
                'status'=>'200',
                'message'=>'Project Added SuccessFully', 
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
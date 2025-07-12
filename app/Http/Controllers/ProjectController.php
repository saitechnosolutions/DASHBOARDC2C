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
            ->addColumn('projectimage', function ($data) {
                if ($data->project_image) {
                    $imageUrl = asset('uploads/projects/' . $data->project_image); // Adjust path as needed
                    return '<img src="' . $imageUrl . '" alt="Blog Image" width="80" height="60">';
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($data) {
                $productIds = ProjectProd::where('project_id', $data->id)->pluck('product_id')->toArray();
                return '
                    <button class="btn btn-sm btn-primary edit-project-products-btn"  
                        data-id="' . $data->id . '" 
                        data-name="' . $data->project_name . '" 
                        data-image="' . $data->project_image . '" 
                        data-products=\'' . json_encode($productIds) . '\'
                        data-bs-toggle="modal" 
                        data-bs-target="#projectproductModal">
                        Edit
                    </button>
                ';
            })
            ->rawColumns(['action','projectimage'])            
            ->toJson();
    }

    public function storeproject(Request $request){
        try {
            $projectTitle = $request->add_project_title;
            $projectProducts = $request->add_project_products;

            if ( $request->hasFile( 'add_project_image' ) ) {
                $file = $request->file( 'add_project_image' );
                $extension = $file->getClientOriginalExtension();
                $imagePath = time() . 'b' . '.' . $extension;
                $file->move( 'uploads/projects', $imagePath );
            }

            $project_unique_name = strtolower(
                preg_replace('/[^a-zA-Z0-9\s]/', '', $projectTitle) // Remove special chars
            );
            
            $project_unique_name = str_replace(' ', '-', $project_unique_name); 

            $project = Project::create([
                'project_name'=>$projectTitle, 
                'project_image'=>$imagePath, 
                'project_url'=>$project_unique_name, 
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

    public function saleindex(){
        try {
            return view( 'pages.saledashboard');
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }
}
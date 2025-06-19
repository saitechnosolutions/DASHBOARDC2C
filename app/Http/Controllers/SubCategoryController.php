<?php

namespace App\Http\Controllers;

use App\DataTables\SubCategoryDataTable;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubCategoryController extends Controller {
    public function index( SubCategoryDataTable $datatable ) {
        try {
            $categories = Category::all();
            return $datatable->render( 'pages.subcategory', compact( 'categories' ) );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable To open Subcategory page'
            ] );
        }
    }

    public function addsubcategory( Request $request ) {
        try {
            $categoryname = $request->category_add_select;
            $subcategoryname = $request->subcategory_add_input;
            // $filename = null;

            if ( $request->hasFile( 'add_subcategory_image' ) ) {

                $file = $request->file( 'add_subcategory_image' );
                $extension = $file->getClientOriginalExtension();
                $filename = time() . 'b' . '.' . $extension;
                $file->move( 'uploads/subcategory', $filename );
            }

            $category = Category::where( 'id', $categoryname )->first();

            SubCategory::create( [
                'category_name'=> $categoryname,
                'subcategory_name'=> $subcategoryname,
                'subcategory_image'=>$filename,
                'category_display'=> $category->category_name,
                'status'=>1,
            ] );

            return response()->json( [
                'status'=>'200',
                'message'=>'SubCategory Added Successfully'
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable add Subcategory'
            ] );
        }
    }

    public function editsubcategory( Request $request ) {
        try {
            $category = $request->category_edit_select;
            $subcategoryname = $request->subcategory_edit_input;
            $subcategory_id = $request->subcategory_edit_id;

            if ( $request->hasFile( 'edit_subcategory_image' ) ) {

                $file = $request->file( 'edit_subcategory_image' );
                $extension = $file->getClientOriginalExtension();
                $filename = time() . 'b' . '.' . $extension;
                $file->move( 'uploads/subcategory', $filename );
            }

            $category = Category::where( 'id', $category )->first();
            $existing_sub = SubCategory::find( $subcategory_id );

            $existing_sub->update( [
                'category_name'=> $category->id,
                'subcategory_name'=> $subcategoryname,
                'category_display'=> $category->category_name,
                'subcategory_image'=> $filename,
                'status'=>1,
            ] );

            return response()->json( [
                'status'=>'200',
                'message'=>'SubCategory Updated Successfully'
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable edit subcategory'
            ] );
        }
    }

    public function deleteSubCategory( Request $request ) {
        try {
            $subcategoryid = $request->subid;

            $subcategory = SubCategory::find( $subcategoryid );

            $subcategory->delete();

            return response()->json( [
                'status'=>'200',
                'message'=>'SubCategory Deleted Successfully'
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable add category'
            ] );
        }
    }

    public function fetchallSubCategory(Request $request)
    {
        $query = SubCategory::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('categoryname', function ($data) {
                return $data->category_display ? $data->category_display : '-';
            })
            ->addColumn('subcategoryname', function ($data) {
                return $data->subcategory_name ? $data->subcategory_name : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                    <button class="btn btn-sm btn-primary edit-subcategory-btn"  
                        data-id="' . $data->id . '" 
                        data-name="' . e($data->subcategory_name) . '" 
                        data-catname="' . e($data->category_name) . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editsubcategoryModal">
                        Edit
                    </button>
            
                    <button class="btn btn-sm btn-danger delete-subcategory-btn"  
                        data-id="' . $data->id . '" 
                        data-name="' . e($data->subcategory_name) . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        Delete
                    </button>
                ';
            })            
            ->toJson();
    }
}
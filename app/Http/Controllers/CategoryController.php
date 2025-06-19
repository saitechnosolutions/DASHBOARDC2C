<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller {
    public function index( CategoryDataTable $datatable ) {
        try {
            return $datatable->render( 'pages.category' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable To open category page'
            ] );
        }
    }

    public function addcategory( Request $request ) {
        try {
            $categoryname = $request->category_add_input;

            if ( $request->hasFile( 'add_category_image' ) ) {

                $file = $request->file( 'add_category_image' );
                $extension = $file->getClientOriginalExtension();
                $filename = time() . 'b' . '.' . $extension;
                $file->move( 'uploads/category', $filename );
            }

            Category::create( [
                'category_name'=> $categoryname,
                'category_image'=> $filename,
                'status'=>1,
            ] );

            return response()->json( [
                'status'=>'200',
                'message'=>'Category Added Successfully'
            ] );
        } catch ( \Throwable $th ) {
            Log::error( $th );
            return response()->json( [
                'status'=>'500',
                'message'=>'Unable add category'
            ] );
        }
    }

    public function getCategories() {
        return datatables()->eloquent( Category::query() )->toJson();
    }

    public function edit( $id ) {
        $category = Category::findOrFail( $id );

        return response()->json( $category );
    }

    public function update( Request $request, $id ) {
        $category = Category::find( $id );

        if ( !$category ) {
            return redirect()->back()->with( 'error', 'Category not found.' );
        }

        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->back()->with( 'success', 'Category updated successfully.' );
    }

    public function destroy( $id ) {
        $category = Category::find( $id );

        if ( !$category ) {
            return redirect()->back()->with( 'error', 'Category not found.' );
        }

        $category->delete();

        return redirect()->back()->with( 'success', 'Category deleted successfully.' );
    }

    public function fetchallCategory(Request $request)
    {
        $query = Category::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('categoryname', function ($data) {
                return $data->category_name ? $data->category_name : '-';
            })
            ->addColumn('action', function ($data) {
                return '
                    <button class="btn btn-sm btn-primary edit-category-btn"  
                        data-id="' . $data->id . '" 
                        data-name="' . e($data->category_name) . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        Edit
                    </button>
            
                    <form action="' . url('/category/delete/' . $data->id) . '" method="POST" class="deleteCategoryForm d-inline">
                        ' . csrf_field() . '
                        ' . method_field('POST') . '
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })            
            ->toJson();
    }
}
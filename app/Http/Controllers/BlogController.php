<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller {
    public function index() {
        try {
            return view( 'pages.blog' );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }

    public function fetchallblogs(Request $request)
    {
        $query = Blog::orderBy('id', 'desc');

        return datatables()->eloquent($query)
            ->addColumn('sno', function ($data) {
                static $rowNumber = 0;
                $rowNumber++;
                $start = request()->input('start', 0);
                return $start + $rowNumber;
                // return $lead ? $lead->delivery_date : '-';
            })
            ->addColumn('blogtitle', function ($data) {
                return $data->blog_title ? $data->blog_title : '-';
            })
            ->addColumn('blogdescription', function ($data) {
                return $data->blog_description ? $data->blog_description : '-';
            })
            ->addColumn('blogimage', function ($data) {
                if ($data->blog_image) {
                    $imageUrl = asset('uploads/blogs/' . $data->blog_image); // Adjust path as needed
                    return '<img src="' . $imageUrl . '" alt="Blog Image" width="80" height="60">';
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($data) {
                return '
                    <button class="btn btn-sm btn-primary view-order-details-btn"  
                        data-id="' . $data->id . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        View
                    </button>
                ';
            })
            ->rawColumns(['blogimage','action','blogdescription'])            
            ->toJson();
    }

    public function storeblog(Request $request){
        try {
            $blogName = $request->add_blog_title;
            $blogDescription = $request->add_blog_dessc;

            if ( $request->hasFile( 'add_blog_image' ) ) {
                $file = $request->file( 'add_blog_image' );
                $extension = $file->getClientOriginalExtension();
                $imagePath = time() . 'b' . '.' . $extension;
                $file->move( 'uploads/blogs', $imagePath );
            }

            $prod_unique_name = strtolower(
                preg_replace('/[^a-zA-Z0-9\s]/', '', $blogName) // Remove special chars
            );
            
            $prod_unique_name = str_replace(' ', '-', $prod_unique_name); 

            Blog::create([
                'blog_title'=> $blogName,
                'blog_description'=> $blogDescription,
                'blog_image'=> $imagePath,
                'blog_url'=>$prod_unique_name,
            ]);

            return response()->json([
                'status'=>'200',
                'message'=>'Blog Added Successfully'
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
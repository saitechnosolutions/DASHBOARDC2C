<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use App\Models\OfferBannerImage;
use Illuminate\Http\Request;

class BannerController extends Controller {
    public function index() {
        $bannerImages =  BannerImage::orderBy( 'id', 'asc' )->get();
        $webbannerImages = OfferBannerImage::orderBy( 'id', 'asc' )->get();
        return view( 'pages.banner', compact( 'bannerImages', 'webbannerImages' ) );
    }

    // ADD

    public function store( Request $request ) {
        $request->validate( [
            'banner_image' => 'required|mimes:png,jpg,webp,jpeg'
        ] );

        if ( $request->hasFile( 'banner_image' ) ) {
            $bannerImage = $request->file( 'banner_image' );
            $path =  $bannerImage->store( 'banner_images', 'public' );
            BannerImage::create( [
                'banner_image' =>  $path,
            ] );

            $bannerImages =  BannerImage::orderBy( 'id', 'asc' )->get();
            $webbannerImages = OfferBannerImage::orderBy( 'id', 'asc' )->get();
            return response()->json( [
                'status'=>'200',
                'message' => 'Banner Image Added Successfully',
            ] );
        }
        return redirect( 'bannerImages' )->with( 'error', 'No Image found' );
    }

    // UPDATE

    
}
<?php

namespace App\Http\Controllers;

use App\Models\ListingImage;
use App\Models\Listing;
use App\Models\User;
use App\Http\Requests\StoreListingImageRequest;
use App\Http\Requests\UpdateListingImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListingImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia('Realtor/ListingImage/Create', [
                'listing' => $listing,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Listing $listing, StoreListingImageRequest $request)
    {
        if($request->hasFile('images')) {
            // $request->validate([
            //     'images.*' => 'mimes:png,jpg,jpeg|max:3000',
            // ], [
            //     'images.*.mimes' => "The files should be either jpg, jpeg, or png",
            //     'images.*.max' => "The maximum file size allowed is 3 MB",
            // ]);
            dd($request->file('images'));
            foreach($request->file('images') as $file) {
                // $path = $file->store('images');
                $fileName = time().'-'.Auth::user()->name.'.'.$file->getClientOriginalExtension();
                $path = $file->move(public_path('images/realtor'), $fileName);

                $listing->images()->save(new ListingImage([
                    'file_name' => 'images/realtor/'.$fileName
                ]));
            }
            return redirect()->back()->with('success', 'Images uploaded!');
        }
        return redirect()->back()->with('error', 'Upload failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(ListingImage $listingImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListingImage $listingImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingImageRequest $request, ListingImage $listingImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($listing, ListingImage $image)
    {
        // Storage::disk('public')->delete($image->file_name);
        if(file_exists(public_path($image->file_name))) {
            unlink(public_path($image->file_name));
        }
        $image->delete();
        return redirect()->back()->with('success', 'Listing image was deleted');
    }
}

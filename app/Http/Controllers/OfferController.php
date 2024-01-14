<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Listing;
use App\Notifications\OfferMade;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;

class OfferController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Listing $listing, StoreOfferRequest $request)
    {
        $this->authorize('view', $listing);
        // $offer = $listing->offer()->save(
        //     Offer::make(
        //         $request->validated(),
        //     )->bidder()->associate($request->user())
        // );
        $offer = $listing->offers()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        $listing->owner->notify(
            new OfferMade($offer)
        );

        return redirect()->back()->with('success', 'Offer was made');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        //
    }
}

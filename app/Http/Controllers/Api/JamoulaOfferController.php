<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JamoulaOffer;
use Illuminate\Http\Request;

class JamoulaOfferController extends Controller
{
    public function index()
    {
        $offers = JamoulaOffer::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }

    public function show($id)
    {
        // Try to find by numeric ID first
        $offer = JamoulaOffer::find($id);

        // If not found, try to find by slug
        if (!$offer) {
            $offer = JamoulaOffer::where('slug', $id)->first();
        }

        if (!$offer) {
            return response()->json([
                'success' => false,
                'message' => 'Offer not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $offer
        ]);
    }
}

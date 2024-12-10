<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    public function rate(Request $request)
    {

        // dd($request->toArray());
        Rating::updateOrCreate([
            'user_id' => Auth::user()->id,
            'pizza_id' => $request->pizzaId,
        ], [
            'rating' => $request->productRating
        ]);
        Alert::success('Rating', 'Rated this product successfully');
        return back();
    }
}

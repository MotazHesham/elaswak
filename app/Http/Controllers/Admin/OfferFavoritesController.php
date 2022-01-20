<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferFavorite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferFavoritesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('offer_favorite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerFavorites = OfferFavorite::with(['user', 'offer'])->get();

        return view('admin.offerFavorites.index', compact('offerFavorites'));
    }
}

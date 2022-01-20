<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFavorite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductFavoritesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_favorite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productFavorites = ProductFavorite::with(['user', 'product'])->get();

        return view('admin.productFavorites.index', compact('productFavorites'));
    }
}

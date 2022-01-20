<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferCart;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferCartsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('offer_cart_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerCarts = OfferCart::with(['offer', 'user'])->get();

        return view('admin.offerCarts.index', compact('offerCarts'));
    }
}

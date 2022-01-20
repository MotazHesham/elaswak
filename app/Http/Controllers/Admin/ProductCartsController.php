<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCart;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCartsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_cart_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCarts = ProductCart::with(['product', 'user'])->get();

        return view('admin.productCarts.index', compact('productCarts'));
    }
}

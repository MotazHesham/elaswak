<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRateRequest;
use App\Models\ProductRate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductRatesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productRates = ProductRate::with(['product', 'user'])->get();

        return view('admin.productRates.index', compact('productRates'));
    }

    public function show(ProductRate $productRate)
    {
        abort_if(Gate::denies('product_rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productRate->load('product', 'user');

        return view('admin.productRates.show', compact('productRate'));
    }

    public function destroy(ProductRate $productRate)
    {
        abort_if(Gate::denies('product_rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productRate->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRateRequest $request)
    {
        ProductRate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

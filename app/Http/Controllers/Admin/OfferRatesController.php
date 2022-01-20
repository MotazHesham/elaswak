<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOfferRateRequest;
use App\Models\OfferRate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfferRatesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('offer_rate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerRates = OfferRate::with(['offer', 'user'])->get();

        return view('admin.offerRates.index', compact('offerRates'));
    }

    public function show(OfferRate $offerRate)
    {
        abort_if(Gate::denies('offer_rate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerRate->load('offer', 'user');

        return view('admin.offerRates.show', compact('offerRate'));
    }

    public function destroy(OfferRate $offerRate)
    {
        abort_if(Gate::denies('offer_rate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $offerRate->delete();

        return back();
    }

    public function massDestroy(MassDestroyOfferRateRequest $request)
    {
        OfferRate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

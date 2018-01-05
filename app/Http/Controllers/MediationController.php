<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Location;
use App\Mediation;
use App\Http\Requests\MediationRequest;

class MediationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.json');
    }

    public function index()
    {
        if (is_null(request()->catId)) {
            abort(400, 'catId parameter is required');
        }

        return Mediation::where('cat_id', request()->catId)->get();
    }

    public function store(MediationRequest $request)
    {
        $cat = Cat::findOrFail($request->cat_id);
        $cat->mediations()->save(Mediation::create($request->all()));
        $cat->locations()->save(Location::create(['location' => $request->location]));
        $cat->update(['status' => 'mediated']);

        return ['message' => trans('messages.mediation_saved'), 'cat_id' => $cat->id];
    }
}

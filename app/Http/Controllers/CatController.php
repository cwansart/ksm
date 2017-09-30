<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Cat;
use App\Http\Requests\CatRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class CatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.json');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Cat::all();
        //return response('', 404);
        return Cat::paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatRequest $request)
    {
        $formData = $request->except('image');

        if (($imageData = $request->get('image')) !== null) {
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            Image::make($imageData)->save(public_path('images/') . $fileName);
            $formData['photo_path'] = $fileName;
        }
            
        $cat = Cat::create($formData);
        return ['message' => trans('messages.cat_saved'), 'cat_id' => $cat->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show(Cat $cat)
    {
        return $cat;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat)
    {
        //
    }
}

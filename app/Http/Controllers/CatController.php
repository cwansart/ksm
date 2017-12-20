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
        switch(request()->filter) {
            case 'present': return Cat::where('is_present', true)->paginate(); break;
            case 'deceased': return Cat::where('is_present', true)->paginate(); break;
        }
        return Cat::paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
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
     */
    public function show(Cat $cat)
    {
        return $cat;
    }

    /**
     * Should not be invoked directly.
     */
    public function edit(Cat $cat)
    {
        abort(404);
    }

    /**
     * Updates the given cat.
     */
    public function update(CatRequest $request)
    {
        $cat = Cat::findOrFail($request->get('id'));
        $formData = $request->except('image');

        if (($imageData = $request->get('image')) !== null) {
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            Image::make($imageData)->save(public_path('images/') . $fileName);
            $formData['photo_path'] = $fileName;
        }

        $cat->update($formData);
        return ['message' => trans('messages.cat_updated'), 'cat_id' => $cat->id];
    }

    /**
     * @Todo: Implemened destroy method.
     */
    public function destroy(Cat $cat)
    {
        abort(501); // Not implemented yet
    }
}

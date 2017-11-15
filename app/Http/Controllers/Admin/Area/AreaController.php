<?php

namespace App\Http\Controllers\Admin\Area;

use App\Http\Requests\StoreAreaFormRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    /**
     * AreaController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Area $area
     * @return \Illuminate\Http\Response
     */
    public function index(Area $area)
    {
        $areas = $area->get()->toFlatTree();

        return view('admin.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::with(['ancestors'])->get()->toFlatTree();

        return view('admin.areas.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAreaFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaFormRequest $request)
    {
        $name = $request->input('name');
        $parent = $request->input('parent');

        $area = new Area();
        $area->name = $name;

        if (isset($parent)) {
            $area->parent_id = $parent;
        }

        $area->usable = $request->input('status');

        if ($area->save()) {
            return redirect()->route('admin.areas.index')
                ->withSuccess("`{$name}` area added successfully.");
        }

        return back()->withInput()
            ->withSuccess("Failed adding area. Try again!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        $areas = Area::with(['ancestors'])->get()->toFlatTree();

        return view('admin.areas.edit', compact('category', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAreaFormRequest|Request $request
     * @param  \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAreaFormRequest $request, Area $area)
    {
        $name = $request->input('name');
        $parent = $request->input('parent');

        $area->name = $name;

        if (isset($parent)) {
            $area->parent_id = $parent;
        }

        $area->usable = $request->input('status');

        if ($area->save()) {
            return redirect()->route('admin.areas.index')
                ->withSuccess("`{$name}` area updated successfully.");
        }

        return back()->withInput()
            ->withSuccess("Failed updating area. Try again!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $name = $area->name;

        if($area->delete()){
            return redirect()->route('admin.area.index')
                ->withSuccess("`{$name}` area deleted successfully.");
        }

        return back()->withInput()
            ->withSuccess("Failed deleting `{$name}` area. Try again!");
    }
}

<?php

namespace App\Http\Controllers\Service;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = $request->category;

        if (isset($category)) {
            $category = Category::where('slug', $category)->firstOrFail();

            $services = Service::with(['category', 'areas' => function ($query) {
                $query->where('service_areas.usable', true);
            }])->fromCategory($category)->latestFirst()->paginate();
        } else {
            $services = Service::with(['category', 'areas' => function ($query) {
                $query->where('service_areas.usable', true);
            }])->latestFirst()->paginate();
        }

        $category = !empty($category->id) ? $category->slug : $category;

        return view('services.index', compact('services', 'category'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function show($service)
    {
        $service = Service::with(['category', 'areas' => function ($query) {
            $query->where('service_areas.usable', true);
        }])->where('slug', $service)->firstOrFail();

        return view('services.show', compact('categories', 'service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}

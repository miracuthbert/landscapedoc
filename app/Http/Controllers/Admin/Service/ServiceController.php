<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Requests\StoreServiceFormRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Price;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * ServiceController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

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

            $services = Service::with(['category'])->fromCategory($category)->latestFirst()->paginate();
        } else {
            $services = Service::with(['category'])->latestFirst()->paginate();
        }

        $category = !empty($category->id) ? $category->slug : $category;

        return view('admin.services.index', compact('services', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog = Category::with(['ancestors', 'children'])
            ->where('slug', 'services')->first();

        $categories = $blog->children()
            ->where('status', true)
            ->whereNotNull('parent_id')
            ->get()->toFlatTree();

        $areas = Area::with(['ancestors'])
            ->where('usable', true)
            ->get()->toFlatTree();

        return view('admin.services.create', compact('categories', 'areas'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreServiceFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceFormRequest $request)
    {
        $areas = $request->areas;

        $service = new Service();
        $service->name = $request->input('name');
        $service->overview = $request->input('overview');
        $service->body = $request->input('body');
        $service->image = $request->input('image');
        $service->category_id = $request->input('category');
        $service->usable = $request->input('status');

        //save
        if ($service->save()) {

            //add service price
            $price = new Price();
            $price->price = $request->input('price');
            $price->usable = true;

            if ($service->prices()->save($price)) {
                $service->prices()->where('id', '<>', $price->id)->update(['usable' => false]);
            }

            //add service areas
            foreach ($areas as $area) {
                //add service areas
                $service->areas()->syncWithoutDetaching([$area => ['usable' => true]]);
            }

            if ($service->usable) {
                return redirect()->route('admin.services.index')
                    ->withSuccess("`{$service->name}` service successfully published.");
            } else {
                return redirect()->route('admin.services.edit', [$service])
                    ->withSuccess("Service saved. You can make changes and publish it when ready.");
            }
        }

        //error
        return back()->withInput()->withError('Failed saving post. Please try again!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $services = Category::with(['ancestors', 'children'])
            ->where('slug', 'services')->first();

        $categories = $services->children()
            ->where('status', true)
            ->whereNotNull('parent_id')
            ->get()->toFlatTree();

        $areas = Area::with(['ancestors'])
            ->where('usable', true)
            ->get()->toFlatTree();

        $serviceables = $service->areas()->where('service_areas.usable', true)->get();

        return view('admin.services.edit', compact('categories', 'areas', 'service', 'serviceables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreServiceFormRequest|Request $request
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(StoreServiceFormRequest $request, Service $service)
    {
        $areas = $request->areas;

        $service->name = $request->input('name');
        $service->overview = $request->input('overview');
        $service->body = $request->input('body');

        if ($request->input('image') != $service->image) {
            $service->image = $request->input('image');
        }

        $service->category_id = $request->input('category');

        if ($service->usable == 0 && $request->input('status') == 1) {
            $service->created_at = Carbon::now();
        }

        $service->usable = $request->input('status');

        //save
        if ($service->save()) {

            //update price
            if ($service->price() != $request->input('price')) {

                $price = new Price();
                $price->price = $request->input('price');
                $price->usable = true;

                if ($service->prices()->save($price)) {
                    $service->prices()->where('id', '<>', $price->id)->update(['usable' => false]);
                }
            }


            //find areas not in list
            $oldAreas = $service->areas()->where('area_id', '<>', $areas)->get()->pluck('id');

            //update areas
            foreach ($oldAreas as $oldArea) {
                $service->areas()->updateExistingPivot($oldArea, ['usable' => false]);
            }

            //add new areas
            foreach ($areas as $area) {
                //add service areas
                $service->areas()->syncWithoutDetaching([$area => ['usable' => true]]);
            }

            if ($service->usable) {
                return redirect()->route('admin.services.index')
                    ->withSuccess("`{$service->name}` service successfully updated and published.");
            } else {
                return back()
                    ->withSuccess("Service saved. You can make changes and publish it when ready.");
            }
        }

        //error
        return back()->withInput()->withError('Failed updating post. Please try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $title = $service->name;

        //disable if it has existing bookings and services
//        if($service->bookings->count() && $service->sales()){
//            $service->usable = false;
//            $service->save();
//
//            return back()
//                ->withSuccess("`{$title}` service successfully disabled.")
//                ->withInfo("This service cannot be deleted since there are existing bookings and sales.");
//        }

        //delete if check for bookings and sales is zero
        $service->forceDelete();

        return back()
            ->withSuccess("`{$title}` service successfully deleted.");

    }
}

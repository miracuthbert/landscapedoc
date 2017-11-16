<?php

namespace App\Http\Controllers\Service;

use App\Models\Area;
use App\Models\Booking;
use App\Models\Budget;
use App\Models\Service;
use App\Models\Timeline;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceBookingController extends Controller
{
    /**
     * ServiceBookingController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth'])->except(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Service $service)
    {
        $user = $request->user();

        //Get only usable areas
        $areas = $service->areas()->where('service_areas.usable', true)->get();

        return view('services.service.bookings.create', compact('service', 'user', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Service $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        //fetch user from request
        $user = $request->user();

        //find area from request
        $area = Area::where('id', $request->area)->firstOrFail();

        //add user if not registered or logged in
        if(!isset($user)) {
            $user = User::updateOrCreate(['email' => $request->email],[
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
        }

        //redirect back if user instance not found
        if(!isset($user)){
            return back()
                ->withError("Please sign or register first to make a booking.")
                ->withInput();
        }

        //save booking
        $booking = new Booking();
        $booking->user()->associate($user);
        $booking->details = $request->details;
        $booking->area()->associate($area);

        //proceed to booking edit on success
        if($service->bookings()->save($booking)){
            return redirect()
                ->route('service.booking.edit', [$service, $booking])
                ->withSuccess("Booking saved. Add budget and timeline to complete.");
        }

        //return back on error
        return back()
            ->withError("Failed saving your booking. Please try again!")
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param  \App\Models\Service $service
     * @param Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Service $service, Booking $booking)
    {
        //Get only usable areas
        $areas = $service->areas()->where('service_areas.usable', true)->get();

        return view('services.service.bookings.edit', compact('service', 'booking', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Service $service
     * @param Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service, Booking $booking)
    {
        //find area from request
        $area = Area::where('id', $request->area)->firstOrFail();

        //budget
        if(!$booking->budget) { //create new budget instance
            $budget = new Budget();
        } else {    //update existing budget
            $budget = $booking->budget()->first();
        }
        $budget->expected_budget = $request->budget;

        $booking->budget()->save($budget);

        //timeline
        if(!$booking->timeline) { //create new timeline instance
            $timeline = new Timeline();
        } else {    //update existing timeline
            $timeline = $booking->timeline()->first();
        }
        $timeline->starts_at = $request->starts_at;
        $timeline->ends_at = $request->ends_at;

        $booking->timeline()->save($timeline);

        //booking
        $booking->details = $request->details;
        $booking->area()->associate($area);
        $booking->created_at = Carbon::now();

        $service->bookings()->save($booking);

        //return with success
        return back()
            ->withSuccess("Booking submitted successfully. You'll be contacted once to confirm.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}

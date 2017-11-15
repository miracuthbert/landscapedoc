<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $services = Service::with(['category', 'areas' => function ($query) {
            $query->where('service_areas.usable', true);
        }])->paginate(3);

        return view('welcome', compact('services'));
    }
}

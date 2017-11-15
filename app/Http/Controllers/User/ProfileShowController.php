<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileShowController extends Controller
{

    /**
     * ProfileShowController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show user profile form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('user.profile');
    }
}

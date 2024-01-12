<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueStoreRequest;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VenueController extends Controller
{
    public function create(Request $request): Response
    {
        return view('venue.create');
    }

    public function store(VenueStoreRequest $request): Response
    {
        $venue = Venue::create($request->validated());

        $request->session()->flash('venue.id', $venue->id);

        return redirect()->route('venue.index');
    }
}

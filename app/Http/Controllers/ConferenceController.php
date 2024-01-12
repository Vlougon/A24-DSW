<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function index(Request $request): Response
    {
        $conferences = Conference::all();

        return view('conference.index', compact('conferences'));
    }

    public function show(Request $request, Conference $conference): Response
    {
        return view('conference.show', compact('conference'));
    }
}

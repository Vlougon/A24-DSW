<?php

namespace App\Http\Controllers;

use App\Models\Talk;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TalkController extends Controller
{
    public function index(Request $request): Response
    {
        $talks = Talk::all();

        return view('talk.index', compact('talks'));
    }

    public function show(Request $request, Talk $talk): Response
    {
        return view('talk.show', compact('talk'));
    }
}

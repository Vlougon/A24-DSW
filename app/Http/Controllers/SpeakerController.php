<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpeakerStoreRequest;
use App\Models\Speaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function store(SpeakerStoreRequest $request): Response
    {
        $speaker = Speaker::create($request->validated());

        $request->session()->flash('speaker.id', $speaker->id);

        return redirect()->route('speaker.index');
    }
}

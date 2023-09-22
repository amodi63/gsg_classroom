<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'content' => ['required', 'string'],
            'id' => ['required', 'int'],
            'type' => ['required', Rule::in(['classwork', 'post'])]
        ]);

        Auth::user()->comments()->create([
            'commentable_id' => $request->input('id'),
            'commentable_type'=> $request->input('type'),
            'content' => $request->input('content'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        return back()->with('success', 'Comment Added!');
    }
}

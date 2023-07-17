<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    //    $topics =  Topic::latest()->get();
    //     return view('topics.index',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request)
    {
       
        Topic::create( $request->validated());
        return redirect()->back()->with('success', 'Topic Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        return response()->json(['data'=> $topic]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        $topic->update($request->validated());
        return redirect()->back()->with('success', 'Topic Updated Successfully!');

    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->back()->with('success', 'Topic Deleted Successfully!');

    }
}

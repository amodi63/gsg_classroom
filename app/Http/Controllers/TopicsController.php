<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Classroom;
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
    public function show(Classroom $classroom ,Topic $topic)
    {
        return response()->json(['data'=> $topic]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request,Classroom $classroom, Topic $topic)
    {
        $topic->update($request->validated());
        return redirect()->back()->with('success', 'Topic Updated Successfully!');

    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom , Topic $topic)
    {
        $topic->delete();
        return redirect()->back()->with('success', 'Topic Deleted Successfully!');

    }

    public function trashed(){

        $topics = Topic::onlyTrashed()->latest('deleted_at')->get();
        return view('topics.trashed',compact('topics'));
    }
    public function restore($id) {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->restore();
        return redirect()->route('classroom.topics.trashed')->with('success', 'Topic Restored Successfully!');
    }
    public function forceDelete($id) {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        
        return redirect()->route('classroom.topics.trashed')->with('success', 'Topic Deleted Forever!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomPeopleController extends Controller
{
    public function index(Classroom $classroom){
        return view('classrooms.people', compact('classroom'));
    }
    public function destroy(Request $request, Classroom $classroom){
        $request->validate([
            'user_id'=> ['requrired']
        ]);
        $user_id = $request->input('user_id');
        if($user_id == $classroom->user_id){
            return redirect()->back()->with('error', "Can/'t Remove!");

        }
        $classroom->users()->detach($user_id);
        return redirect()->back()->with('success', 'User Removed!');
    }
}

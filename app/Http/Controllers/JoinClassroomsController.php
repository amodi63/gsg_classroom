<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassroomUser;
use App\Models\Scopes\UserScope;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JoinClassroomsController extends Controller
{
    public function create($classroom)
    {
        $classroom  = Classroom::withoutGlobalScope(UserScope::class)->active()->findOrFail($classroom);
        try {
            $this->exists($classroom->id, Auth::id());
            return view("classrooms.join", compact('classroom'));
        } catch (Exception $e) {
            return redirect()->route('classrooms.show', $classroom->id);
        }
    }
    public function store(Request $request, $classroom)
    {
        $request->validate([
            'role' => 'in:student,teacher',
        ]);
        $classroom = Classroom::withoutGlobalScope(UserScope::class)->active()->findOrFail($classroom);
        $extra_data = [
            'role' => $request->input('student', 'student'),
            'created_at' => now()
        ];
        try {
            $this->exists($classroom, Auth::id());
            $classroom->users()->attach(Auth::id(), $extra_data);
            return redirect()->route('classrooms.show', $classroom->id);
        } catch (Exception $e) {
            return redirect()->route('classrooms.show', $classroom->id);
        }
    }
    public function exists($classroom_id, $user_id)
    {
        $exists = DB::table('classroom_user')->where('classroom_id', $classroom_id)->where('user_id', $user_id)->exists();
        if ($exists) throw new Exception('User Already joined the classroom');
        
    }
}

<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomCollection;
use App\Models\Classroom;
use Illuminate\Contracts\Auth\Authenticatable;

class ClassroomController extends Controller {
public function index() {
    $classrooms =  Classroom::with('user')->get();
    return response()->json(new ClassroomCollection($classrooms));
}

public function login(Authenticatable $login )
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Topic;
use App\Traits\Image;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class ClassroomsController extends Controller
{
    use Image;
    public function index(): View
    {

        $classrooms = Classroom::latest()->get();

        return view('classrooms.index', compact('classrooms'));
    }
    public function create(): View
    {
        return view('classrooms.create', [
            'classroom' => new Classroom()
        ]);
    }
    public function store(ClassroomRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->except(['classroom_image', 'cover_image_path']);
            $data['classroom_image'] =  $this->storeImage($request, 'classroom_image', '/uploads/classrooms');
            $data['cover_image_path'] = $this->storeImage($request, 'cover_image_path', '/uploads/classrooms/covers');
            $classroom =  Classroom::create($data);

            $extra_data = ['role' => 'teacher','created_at' => now()];
            $classroom->users()->attach(Auth::id(), $extra_data);
            DB::commit();
            return redirect()->route('classrooms.index')->with('success', 'Classroom Created Successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Faild To Save Classroom!');
        };
    }
    public function show(Classroom $classroom): View
    {

        $topics = Topic::where('classroom_id', $classroom->id)->latest('id')->get();
        
        $classworks = $classroom->classworks()->with('topic')->orderBy('published_at')->lazy();
    
        $invitation_link = URL::signedRoute('classrooms.join', ['classroom'=>$classroom->id, 'code'=> $classroom->code]);

        return view('classrooms.show', compact('classroom', 'topics', 'invitation_link'))->with('classworks' ,  $classworks->groupBy('topic_id'));
    }
    public function edit(Classroom $classroom): View
    {

        return view('classrooms.edit', compact('classroom'));
    }
    public function update(ClassroomRequest $request, Classroom $classroom): RedirectResponse
    {

        $data = $request->except(['classroom_image', 'cover_image_path']);

        $data['classroom_image'] =   $this->updateImage($request, $classroom, 'classroom_image', '/uploads/classrooms');
        $data['cover_image_path'] =   $this->updateImage($request, $classroom, 'cover_image_path', '/uploads/classrooms/covers');

        $classroom->update($data);
        return redirect()->route('classrooms.index')->with('success', 'CLassroom Updated Successfully!');
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        $status =  $classroom->delete();
        if ($status) {

            $this->deleteImage($classroom->classroom_image);
            $this->deleteImage($classroom->cover_image_path);
            return redirect()->route('classrooms.index')->with('success', 'Classroom deleted successfully.');
        }
        return redirect()->route('classrooms.index')->with('error', 'Failed to delete the classroom.');
    }
}

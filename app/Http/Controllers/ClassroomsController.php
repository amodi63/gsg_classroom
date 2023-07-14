<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ClassroomsController extends Controller
{
    public function index(): View
    {

        $classrooms = Classroom::all();

        return view('classrooms.index', compact('classrooms'));
    }
    public function create(): View
    {
        return view('classrooms.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $data = $request->except(['classroom_image', 'cover_image_path']);
        if ($request->hasFile('classroom_image')) {
            $classroom_image_path =    $request->file('classroom_image')->store('/uploads/classrooms', 'public');
            $data['classroom_image'] = $classroom_image_path;
        }
        if ($request->hasFile('cover_image_path')) {
            $classroom_cover_path =    $request->file('cover_image_path')->store('/uploads/classrooms/covers', 'public');
            $data['cover_image_path'] = $classroom_cover_path;
        }

        Classroom::create($data);
        return redirect()->route('classrooms.index');
    }
    public function show(Classroom $classroom): View
    {

        return view('classrooms.show', compact('classroom'));
    }
    public function edit(Classroom $classroom): View
    {

        return view('classrooms.edit', compact('classroom'));
    }
    public function update(Request $request, Classroom $classroom): RedirectResponse
    {
        $data = $request->except(['classroom_image', 'cover_image_path']);

        if ($request->hasFile('classroom_image')) {
            if ($classroom->classroom_image) {
                Storage::disk('public')->delete($classroom->classroom_image);
            }
            $classroom_image_path = $request->file('classroom_image')->store('/uploads/classrooms', 'public');
            $data['classroom_image'] = $classroom_image_path;
        }

        if ($request->hasFile('cover_image_path')) {
            if ($classroom->cover_image_path) {
                Storage::disk('public')->delete($classroom->cover_image_path);
            }

            $classroom_cover_path = $request->file('cover_image_path')->store('/uploads/classrooms/covers', 'public');
            $data['cover_image_path'] = $classroom_cover_path;
        }

        $classroom->update($data);
        return redirect()->route('classrooms.index');
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
       $status =  $classroom->delete();
        if ($status) {
            
            if ($classroom->classroom_image) {
                Storage::disk('public')->delete($classroom->classroom_image);
            }
            if ($classroom->cover_image_path) {
                Storage::disk('public')->delete($classroom->cover_image_path);
            }
            return redirect()->route('classrooms.index')->with('success', 'Classroom deleted successfully.');
        }
        return redirect()->route('classrooms.index')->with('error', 'Failed to delete the classroom.');

    
    }
}

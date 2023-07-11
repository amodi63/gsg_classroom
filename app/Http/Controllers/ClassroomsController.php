<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClassroomsController extends Controller
{
    public function index() :View {

        // return Redirect::away();
        return view('classrooms.index');
    }
    public function create() {
        return view('classrooms.create');
    }
    public function store() {
        // return view('classrooms.index');
    }
    public function show($clsssroom) {
        return view('classrooms.edit');
    }
    public function edit($classroom) {
        return view('classrooms.edit',compact('classroom'));
    }
    public function update() {
        //
    }
    public function delete() {
      //
    }
}

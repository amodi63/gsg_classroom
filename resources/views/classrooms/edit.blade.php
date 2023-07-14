@extends('layouts.master')
@section('title', 'Classrooms')
@section('content')

    <h1>Classrooms</h1>
    <form  action="{{ route('classrooms.update', $classroom->id ) }}"  method="post" enctype="multipart/form-data">
      @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name"  value="{{ $classroom->name }}" id="name" placeholder="Enter Class Name">
            <label for="name">CLass Name </label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="section" value="{{ $classroom->section }}" id="section" placeholder="Enter Section Name">
            <label for="text">Section</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="subject" value="{{ $classroom->subject }}" id="subject" placeholder="Enter Subject Name">
            <label for="subject">Subject</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="room" value="{{ $classroom->room }}" id="room" placeholder="Enter Room Name">
            <label for="room">Room</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control " type="file" name="classroom_image" id="classroom_image">
            <label for="classroom_image" class="custom-file-label">Class Image</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control " type="file" name="cover_image_path" id="cover_image_path">
            <label for="cover_image_path" class="custom-file-label">CLass Cover Image</label>
          </div>
          <button type="submit" class="btn btn-primary">Update Classroom</button>
    </form>
  @endsection

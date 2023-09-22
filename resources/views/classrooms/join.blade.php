@extends('layouts.master')
@push('name')
    
@endpush
@section('title', "Join Classroom")
@section('content')

<div class="d-flex justify-content-center align-items-center vh-100" style="overflow: hidden;">
    <div class="text-center">
      <h1>Welcome to {{ config('app.name') }}</h1>
      <p>Join to {{ $classroom->name }} Class</p>
      <form action="{{ route('classrooms.join', $classroom->id) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg">Join Now</button>
    </form>
      
    </div>
  </div>
@endsection
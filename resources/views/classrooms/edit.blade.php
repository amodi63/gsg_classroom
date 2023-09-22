@extends('layouts.master')
@section('title', 'Classrooms')
@section('content')

    <h1>Update Classroom {{ $classroom->name }}</h1>
    @include('classrooms._form', ['btn_text' => 'Update Classroom', 'action'=> route('classrooms.update', $classroom->id)])
    
@endsection

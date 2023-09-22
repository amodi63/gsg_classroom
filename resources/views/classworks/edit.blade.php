@extends('layouts.master')
@section('title', 'Classrooms')
@section('content')
    <h1>Update Classwork</h1>
    <x-alert-messsages type="error" />
    <div class="row gap-5">
        <div class="col-md-6 ">

            @include('classworks._form', [
                'btn_text' => 'Update Classwork',
                'action' => route('classworks.update', ['classwork' => $classroom->id, 'type' => $type]),
            ])
        </div>
        <div class="col-md-4">
            <h4 class="h4">Students</h4>

            <ul class="list-group">

                @foreach ($classroom->students()->orderBy('name')->get() as $student)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input me-1" type="checkbox" name="students[]" value=""
                                    id="{{ $student->id }}" @checked(in_array($student->id, $assigned))>
                                <label class="form-check-label" for="{{ $student->id }}">{{ $student->name }}</label>
                            </div>
                        </div>
                    </li>
                @endforeach


            </ul>

        </div>
    </div>

@endsection

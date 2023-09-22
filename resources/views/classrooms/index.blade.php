@extends('layouts.master')
@push('name')
@endpush
@section('title', 'Classrooms')
@section('content')
    <x-alert-messsages type="success" />
    <div class="row d-flex flex-end justify-content-end pb-4" style="padding-right: 10px;">
        <a href="{{ route('classrooms.create') }}" class="btn btn-primary w-auto">
            <i class="fa fa-add"></i> Create Classroom
        </a>
    </div>
    <h2 class="mb-4">Classrooms</h2>

    <div class="row ">
        @forelse ($classrooms as $classroom)
            <div class="col-md-3 ">
                <x-classroom.card :classroom="$classroom" />
            </div>

        @empty
            <div class="col-md-12">
                <div class="alert alert-info">No Classes Found</div>
            </div>
        @endforelse
    </div>


@endsection

@extends('layouts.master')
@section('title', 'Classrooms')
@section('content')



<div class="row">
@forelse ($classrooms as $classroom)


    <div class="col-md-3">
        <div class="card">
            <img src="{{asset('storage/'.$classroom->classroom_image) }}" class="card-img-top" alt="Classroom Image" style="max-height: 250px;">
            <div class="card-body">
                <h5 class="card-title">{{ $classroom->room }}</h5>
                <p class="card-text">{{ $classroom->description }}</p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ route('classrooms.show', $classroom->id) }}" class="btn btn-primary btn-block w-100"><i class="fas fa-eye"></i> View</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-warning btn-block w-100"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                    <div class="col-4">
                        <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block w-100"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    @empty
    <div class="col-md-12">
        <div class="alert alert-info">No Classes Found</div>
    </div>
    @endforelse
</div>



@endsection

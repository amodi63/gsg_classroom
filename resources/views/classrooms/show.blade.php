@extends('layouts.master')
@section('title', 'Classrooms')
@section('content')
    <x-alert-messsages type="success" />

    <div class="row align-items-start">
        <div class="row pb-4">
            <div class="col-12">
                @if ($classroom->cover_image_path)
                    <img src="{{ asset('storage/' . $classroom->cover_image_path) }}" class="img-thumbnail mt-2"
                        style="height: 30vh;" width="100%" alt="Cover Image">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="h4">Topics:</h3>
                        <button type="button" class="btn btn-primary w-40" data-bs-toggle="modal" data-bs-target="#topicModal">
                            <i class="fa fa-plus"></i>
                            Add 
                        </button>
                    </div>
                    <div class="card-body">
                        @isset($topics)
                        @forelse($topics as $topic)
                            <div class="alert alert-info d-flex align-items-center justify-content-between" role="alert">
                                <div>
                                    <strong> <span class="topic-number text-bold">{{ $loop->iteration }}</span> - {{ $topic->name }}</strong>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="assignmentOptions"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="assignmentOptions">
                                        <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#editTopicModal"><i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('topics.destroy', $topic->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info" role="alert">
                                No Topics Found Yet!
                            </div>
                        @endforelse
                    @endisset
                    
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="h4">Classroom Code</h3>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <span class="badge rounded-pill bg-success text-white text-center" style="font-size: 1.25rem;">
                            {{ $classroom->code }}
                        </span>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-9">
                <div class="alert alert-info" role="alert">
                    Demo Content!
                </div>
            </div>
        </div>
        
        
    </div>
    

    @include('topics.modals._add-topic')
    @include('topics.modals._edit-topic')

@endsection

@extends('layouts.master')
@section('title', $classwork->title . ' Details')

@section('content')
<x-alert-messsages type="success" />

<div class="classwork-details text-capitalize">
    <h3>{{ $classwork->title }}</h3>
    <hr>
    <div class="classwork-description">
        <p>{{ $classwork->description }}</p>
    </div>
    <h4>Comments</h4>
    <div class="list-group comments-list mb-4">
        @foreach ($classwork->comments()->with('user')->latest()->get() as $comment)
            <div class="list-group-item list-group-item-action">
                <div class="d-flex align-items-start gap-3">
                    <img src="{{ $comment->user->avatar }}" class="rounded-circle" alt="User Image" width="48" height="48">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ $comment->user->name }}</h5>
                        <p class="mb-1">{{ $comment->content }}</p>
                        <small class="text-muted ">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
    
    <h6>Add a Comment</h6>

    <form action="{{ route('comments.store') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $classwork->id }}">
        <input type="hidden" name="type" value="classwork">
        @if($type == 'assignment')
        
        @endif
        <div class="d-flex">
            <div class="form-floating flex-grow-1 me-3 ">
                <textarea name="content" class="form-control" id="content" rows="4">{{ old('content') }}</textarea>
                <label for="content">Content</label>
            </div>
            
            <button type="submit" class="btn btn-primary align-self-end">Comment</button>
        </div>
    </form>
    
</div>




 @endsection
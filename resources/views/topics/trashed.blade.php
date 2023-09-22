@extends('layouts.master')
@push('name')
@endpush
@section('title', 'Trahsed Topics')
@section('content')

    <x-alert-messsages type="success" />

    <h2 class="mb-4">Trashed Topics</h2>



    <div class="list-group list-group-item">
      @forelse ($topics as $topic)
          <div class="row d-flex align-items-center">
              <div class="col">
               
                  <a style="text-decoration: none;" class=" list-group-item-action" href="{{ route('classrooms.show', $topic->classroom_id) }}">
                     {{ $topic->name }}
                     
                  </a>
                  
              </div>
              <div class="col-auto">
                  <form action="{{ route('topics.restore', $topic->id) }}" method="post">
                      @csrf
                      @method('put')
                      <button type="submit" class="btn btn-success">
                        <i class=" fa-trash-undo"></i> Restore
                      
                      </button>
                  </form>
              </div>
              <div class="col-auto">
                  <form action="{{ route('classrooms.destroy', $topic->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                          <i class="fa fa-trash-alt"></i> Force Delete
                      </button>
                  </form>
              </div>
          </div>
      @empty
          <a href="javascript:;" class="list-group-item list-group-item-action ">
              No Topics Found!
          </a>
      @endforelse
  </div>
@endsection  

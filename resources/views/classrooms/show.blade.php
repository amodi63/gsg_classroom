@extends('layouts.master')
@section('title', 'Classrooms')
@section('content')
    <div class="row align-items-start">
        <div class="row">
            <div class="col-12">
                @if ($classroom->cover_image_path)
                <img src="{{ asset('storage/'.$classroom->cover_image_path) }}" class="img-thumbnail mt-2 " style="height: 30vh;"  width="100%"   alt="Cover Image">
            @endif
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        {{ $classroom->code }}
                    </div>
                </div>
            </div>
            <div class="col-md-8">
             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia neque, eum alias, omnis modi doloribus excepturi blanditiis, ut quidem impedit dolorum sapiente saepe fugiat nam iusto quis aliquam repudiandae eaque.
            </div>
        </div>
      
  </div>
@endsection

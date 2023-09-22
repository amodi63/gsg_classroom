@extends('layouts.master')
@section('title', 'Classrooms')
@section('content')
    <x-alert-messsages type="success" />

    <div class="row">
        <div class="col-md-12">
            <div class="row pb-4">
                <div class="col-12">
                    @if ($classroom->cover_image_path)
                        <img src="{{ asset('storage/' . $classroom->cover_image_path) }}" class="img-thumbnail mt-2"
                            style="height: 30vh;" width="100%" alt="Cover Image">
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="h4">Topics:</h4>
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
                                    <strong><span class="topic-number text-bold">{{ $loop->iteration }}</span> -
                                        {{ $topic->name }}</strong>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="assignmentOptions"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="assignmentOptions">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTopicModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('classroom.topics.destroy', [$classroom->id, $topic->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Are you sure?')">
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
                    <h4 class="h4">Classroom Code</h4>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <span class="badge rounded-pill bg-success text-white text-center" style="font-size: 1.25rem;">
                        {{ $classroom->code }}
                    </span>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="h4">Invitation Link</h4>
                    <button class="btn btn-primary btn-sm copy-button">Copy</button>

                </div>
                <div class="card-body">
                    <a href="{{ $invitation_link }}" class="invitation-link">{{ $invitation_link }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-end gap-3">

                <a href="{{ route('classrooms.people', $classroom->id) }}" class="btn btn-primary btn-sm " style="height: 40px">
                    <i class="fa fa-users me-2"></i> People
                </a>
                
                
                

                <button type="button" class="btn btn-primary  dropdown-toggle dropdown-toggle-split mb-3  "
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-plus me-2"></i>Create
                </button>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item text-capitalize"
                            href="{{ route('classroom.classworks.create', ['classroom' => $classroom->id, 'type' => Classwork::TYPE_ASSIGNMENT]) }}">{{ Classwork::TYPE_ASSIGNMENT }}</a>
                    </li>
                    <li><a class="dropdown-item text-capitalize"
                            href="{{ route('classroom.classworks.create', ['classroom' => $classroom->id, 'type' => Classwork::TYPE_MATERIAL]) }}">{{ Classwork::TYPE_MATERIAL }}</a>
                    </li>
                    <li><a class="dropdown-item text-capitalize"
                            href="{{ route('classroom.classworks.create', ['classroom' => $classroom->id, 'type' => Classwork::TYPE_QUESTION]) }}">{{ Classwork::TYPE_QUESTION }}</a>
                    </li>
                </ul>
            </div>
            @isset($classworks)
            @forelse ($classworks as $group)
                <h4 class="h4 mb-2">{{ $group->first()->topic->name }}</h4>
                <div class="accordion mb-3" id="accordion{{ $classroom->id }}">
                    @foreach ($group as $classwork)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $classwork->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $classwork->id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $classwork->id }}">
                                    {{ $classwork->title }}
                                </button>
                            </h2>
                            <div id="collapse{{ $classwork->id }}" class="accordion-collapse collapse"
                                 aria-labelledby="heading{{ $classwork->id }}" data-bs-parent="#accordion{{ $classwork->id }}">
                                <div class="accordion-body">
                                    {{ $classwork->description }}
                                    <div class="d-flex justify-content-end gap-2">
                                        <a class="btn btn-sm btn-primary" href="{{ route("classworks.show", $classwork->id) }}">Show</a>
                                        <a class="btn btn-sm btn-warning" href="{{ route("classworks.edit",[ $classwork->id, 'type'=> $classwork->type]) }}">Edit</a>

                                        <form action="{{ route('classworks.destroy', $classwork->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="alert alert-primary" role="alert">
                    No Classworks Found Yet!
                </div>
            @endforelse
            
            
            
            
          
            
            @endisset
        </div>
    </div>


    

    @include('topics.modals._add-topic')
    @include('topics.modals._edit-topic')
   
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.copy-button').click(function() {

                var invitationLink = $('.invitation-link').text();
                var tempInput = $('<input>');
                $('body').append(tempInput);

                tempInput.val(invitationLink).select();

                document.execCommand('copy');


                tempInput.remove();

                $(this).text('Copied!');
                setTimeout(function() {
                    $('.copy-button').text('Copy');
                }, 2000);
            });
        });
    </script>
@endpush

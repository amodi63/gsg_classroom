@extends('layouts.master')
@section('title', 'Classroom People')
@section('content')
<div class="row">
    <x-alert-messsages type="error" />
    <x-alert-messsages type="success" />
    <div class="col-md-6">
        <h4>Teachers</h4>
        <ul class="list-group">
            @forelse($classroom->teachers()->orderBy('name')->get() as $teacher)
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">

                <div class="form-check">
                    <input class="form-check-input me-1" type="checkbox" value="" id="{{ $teacher->id }}">
                    <label class="form-check-label" for="{{ $teacher->id }}">{{ $teacher->name }}</label>
                </div>
                <div>
                        
                       
                    <a href="javascript:;" class="remove-user-link" data-user-id="{{ $teacher->id }}">
                        <i class="fas fa-times-circle text-danger"></i>
                    </a>
                    <form id="delete-form-{{ $teacher->id }}" action="{{ route('classrooms.people.destroy', [$classroom->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                </div>
            </li>
            @empty
            <li class="list-group-item">
                <label class="form-check-label">No Teachers yet!</label>
            </li>
            @endforelse
        </ul>
    </div>
    <div class="col-md-6">
        <h4>Students</h4>
        <ul class="list-group">
            @forelse($classroom->students()->orderBy('name')->get() as $student)
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input me-1" type="checkbox" value="" id="{{ $student->id }}">
                        <label class="form-check-label" for="{{ $student->id }}">{{ $student->name }}</label>
                    </div>
                    <div>
                        
                        <a href="javascript:;" class="remove-user-link" data-user-id="{{ $student->id }}">
                            <i class="fas fa-times-circle text-danger"></i>
                        </a>
                        <form id="delete-form-{{ $student->id }}" action="{{ route('classrooms.people.destroy', [$classroom->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                    </div>
                       

                    
                </div>
            </li>
            @empty
            <li class="list-group-item">
                <label class="form-check-label">No Students yet!</label>
            </li>
            @endforelse
        </ul>
    </div>
</div>



@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
   
<script>
    $(document).ready(function() {
        $('.remove-user-link').click(function() {
            const userId = $(this).data('user-id');
            const form = $('#delete-form-' + userId);

            if (confirm('Are you sure you want to remove this user?')) {
                form.submit();
            }
        });
    });
</script>

@endpush

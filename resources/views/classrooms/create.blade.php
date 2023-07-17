
 @extends('layouts.master')
 @section('title', 'Classrooms')
 @section('content')
    <h1>Create New Classroom</h1>
    @include('classrooms._form', ['btn_text' => 'Create Classroom', 'action'=> route('classrooms.store') ])
</div>
@endsection

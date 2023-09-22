
<form action="{{ $action }}" method="post" enctype="multipart/form-data">
    @csrf
    @isset($classwork->id)
        @method('PUT')
    @endisset
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="title" value="{{ old('title', $classwork->title) }}" id="name"
            placeholder="Enter Class Name">
        <label for="name">CLass Name </label>
    </div>
    <div class="form-floating mb-3">

            <textarea name="description" class="form-control" id="description" rows="4" >{{ old('description', $classwork->description) }}</textarea>
        <label for="text">Description (Optional)</label>
    </div>
    @if($type == 'assignment')
    <div class="form-floating mb-3">

        <x-form.input type="number" min="0" name="options[grade]" value="{{ $classroom->options['grade'] ?? '' }}" />
            <label for="text">Grade</label>
        <x-form.input type="date" min="0" name="options[due]" value="{{ $classroom->options['due'] ?? '' }}" />
            <label for="text">Due</label>
</div>
    @endif
    <div class="form-floating mb-3">    
        
            <select class="form-select" name="topic_id" id="topic_id">
                <option value="">Select Topic</option>
                @foreach($classroom->topics as $topic)
                <option value="{{ $topic->id }}" @selected($topic->id == $classwork->topic_id) >{{ $topic->name }}</option>
                @endforeach
            </select>
        <label for="Topic">Topic</label>
       

    </div>
   
    
    
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk "></i>{{ $btn_text }}</button>
</form>

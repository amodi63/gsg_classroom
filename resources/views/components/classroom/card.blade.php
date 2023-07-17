
<div class="card">
    <img src="{{asset('storage/'.$classroom->classroom_image) }}" class="card-img-top" alt="Classroom Image" style="max-height: 250px;">
    <div class="card-body">
        <h5 class="card-title">{{ $classroom->room }}</h5>
        <p class="card-text">{{ $classroom->description }}</p>
    </div>
    
    <div class="card-footer">
        <div class="row">
            <div class="col-4 p-1">
                <a href="{{ route('classrooms.show', $classroom->id) }}" class="btn btn-primary  ">
                    <i class="fa fa-eye mr-2"></i> View
                </a>
            </div>
            <div class="col-4 p-1">
                <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-warning    ">
                    <i class="fa fa-edit mr-2"></i> Edit
                </a>
            </div>
            <div class="col-4 p-1">
                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ">
                        <i class="fa fa-trash-alt "></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    
    
    
    
</div>

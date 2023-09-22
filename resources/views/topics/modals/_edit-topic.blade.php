<div class="modal fade" id="editTopicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        @isset($topic)
        <div class="modal-content">
           
                
           
            <form action="{{ route('classroom.topics.update',[$classroom->id ,$topic->id]) }}" method="post">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Topic</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    @method("PUT")
                    <div class="form-floating mb-3">
                        <x-form.input name="name"  value="{{ $topic->name }}"/>
                        <x-form.input type="hidden" name="classroom_id" value="{{ $classroom->id }}" />
                        <label for="classroom_image" class="custom-file-label">Topic Name</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk "></i>Update</button>
                    </div>
                </form>
        </div>
        @endisset
    </div>
</div>

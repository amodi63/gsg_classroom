<div class="modal fade" id="topicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('topics.store') }}" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Topic</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="form-floating mb-3">
                        <x-form.input name="name" />
                        <x-form.input type="hidden" name="classroom_id" value="{{ $classroom->id }}" />
                        <label for="classroom_image" class="custom-file-label">Topic Name</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk "></i>Save</button>
                    </div>
                </form>
        </div>
    </div>
</div>

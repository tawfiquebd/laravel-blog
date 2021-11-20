
<!-- View Contact Message -->
<div class="modal fade" id="msgModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="msgForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Contact Message</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="">
                    </div>

                    <div class="form-group">
                        <label for="message">Name</label>
                        <textarea class="form-control" name="message" id="message" ></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit category modal -->
<div class="modal fade" id="editTagModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editTag">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Tag</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">

                    <input type="hidden" name="tag_id" class="form-control" id="tag_id" >

                    <div class="form-group">
                        <label for="category_name">Tag Name</label>
                        <input type="text" name="edit_tag" class="form-control" id="edit_tag" placeholder="Tag name...">
                        <small class="text-danger" id="edit_tag_help"></small>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Product  Color Insert modal -->
<div id="color_insert_modal" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Product Color Insert Form</h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">

                        <label>Color Name:</label>
                        <input type="text" name="colorName" maxlength="20" required class="form-control">
                        <input type="hidden" name="colorType" >
                        <span class="help-block text-warning">Enter Your Product Color Name</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="colorCode" class="form-control colorpicker-flat-input" data-width="100%" data-preferred-format="hex" required >
                            <span class="help-block text-warning cleCode">Choose a valid Color</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-success color-store">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- /Product Primary Color Store modal -->

<!-- Product  Color Edit modal -->
<div id="color_edit_modal" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Product Color Insert Form</h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">

                        <label>Color Name:</label>
                        <input type="text" name="colorName" maxlength="20" required class="form-control">
                        <input type="hidden" name="colorId" >
                        <input type="hidden" name="colorType" >
                        <span class="help-block text-warning">Enter Your Product Color Name</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="colorCode" class="form-control colorpicker-flat-input" data-width="100%" data-preferred-format="hex" required >
                            <span class="help-block text-warning cleCode">Choose a valid Color</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-success color-update">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- /Product Color Edit modal -->



<!-- Delete Gift Item Model -->
<div id="color_delete_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Delete Product Color Information</h5>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert">
                    Are You Sure You Want to Delete This Color ?
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button  class="btn btn-danger" id="color_delete">Delete</button>
            </div>

        </div>
    </div>
</div>
<!-- /Delete Gift Item Model -->
<!-- Product Size Insert  modal -->
<div id="material_insert_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Insert New Material Information</h5>
			</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<label>Material Name: <span class="text-danger">*</span></label>
							<input type="text" name="materialName" maxlength="20" value="{{ old('materialName') }}" required placeholder="Name Must Be Unique ( Max 20 characters)" class="form-control">
							<span class="help-block text-warning">Name Must Be Unique ( Max 20 characters)</span>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							    <label>Material Description: <span class="text-danger">*</span></label>
								<textarea name="details"  rows="5" cols="3" maxlength="250" required class="form-control maxlength-textarea" placeholder="Write Short Description (Max 200 Characters) ">{{ old('details') }}</textarea>
								<span class="help-block text-warning"> Write Short Description (Max 200 Characters) </span>
							</div>
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button  class="btn btn-success" id="material_submit">Save</button>
				</div>
		</div>
	</div>
</div>
<!-- /Product Size Insert modal -->

<!-- Product Size Edit  modal -->
<div id="material_edit_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Edit Product Material Information</h5>
			</div>
				<div class="modal-body">
					<input type="hidden" name="materialId">
					<div class="row">
						<div class="col-md-12">
							<label>Material Name:</label>
							<input type="text" name="materialName" maxlength="20"  required class="form-control">
							<span class="help-block text-warning">Name Must Be Unique ( Max 20 characters)</span>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							    <label>Material Description: <span class="text-danger">*</span></label>
								<textarea name="details"  rows="5" cols="3" maxlength="250" class="form-control maxlength-textarea" placeholder="Write Short Description (Max 200 Characters)"></textarea>
								<span class="help-block text-warning">Write Short Description (Max 200 Characters)</span>
							</div>
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button  class="btn btn-success" id="material_update">Update</button>
				</div>
		</div>
	</div>
</div>
<!-- /Product Size Edit modal -->

<!-- Delete Gift Item Model -->
<div id="material_delete_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Delete Product Material Information</h5>
			</div>

			<div class="modal-body">
				<div class="alert alert-warning" role="alert">
					Are You Sure You Want to Delete This Material ?
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button  class="btn btn-danger" id="material_delete">Delete</button>
			</div>

		</div>
	</div>
</div>
<!-- /Delete Gift Item Model -->
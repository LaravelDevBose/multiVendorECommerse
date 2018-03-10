
<!-- Slider Item Insert modal -->
<div id="slider_insert_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Insert Slider Image</h5>
			</div>
			<form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Slider Title: </label>
								<input type="text" name="sliderTitle" class="form-control" maxlength="50" required placeholder="Enter Slider Title (Max 50 characters)">
								<span class="help-block text-warning">Enter Slider Title (Max 50 characters)</span>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Slider Note: </label>
								<input type="text" name="shortNote" class="form-control" required maxlength="50" placeholder="Enter Slider Short Note (Max 50 characters)">
								<span class="help-block text-warning">Enter Slider Short Note (Max 50 characters)</span>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Button Title: </label>
								<input type="text" name="buttonTitle" class="form-control" maxlength="15" required placeholder="Enter Button Title (Max 15 characters)">
								<span class="help-block text-warning">Enter Button Title (Max 15 characters)</span>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Button URL: </label>
								<input type="url" name="url" class="form-control" required  placeholder="Enter Button URL Full Link ">
								<span class="help-block text-warning">Enter Button URL full path...</span>
							</div>
						</div>

					</div>


					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label>Publication: </label>
								<select class="bootstrap-select" required name="publicationStatus" data-width="100%">
									<option value="1">Published</option>
									<option value="0">Unpublished</option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="image" class="file-input-ajax" required accept="image/*">
								<span class="help-block text-warning">Insert a Slider Image</span>
							</div>
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /slider Item Insert modal -->

<!-- Slider Item Update modal -->
<div id="slider_edit_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Gift Item</h5>
			</div>
			<form action="{{ route('slider.update') }}" method="POST"  enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="row">
						<input type="hidden"  name="sliderId">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Slider Title: </label>
								<input type="text" name="sliderTitle"  class="form-control" maxlength="30" required placeholder="Enter Slider Title (Max 30 characters)">
								<span class="help-block text-warning">Enter Slider Title (Max 30 characters)</span>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Slider Note: </label>
								<input type="text" name="shortNote"  class="form-control" required maxlength="50" placeholder="Enter Slider Short Note (Max 50 characters)">
								<span class="help-block text-warning">Enter Slider Short Note (Max 50 characters)</span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Button Title: </label>
								<input type="text" name="buttonTitle" class="form-control" maxlength="15" required placeholder="Enter Button Title (Max 15 characters)">
								<span class="help-block text-warning">Enter Button Title (Max 15 characters)</span>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Button URL: </label>
								<input type="text" name="url" class="form-control" required  placeholder="Enter Button URL Full Link ">
								<span class="help-block text-warning">Enter Button URL full path...</span>
							</div>
						</div>

					</div>
					
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label> Publication: </label>
								<select class="form-control" required  name="publicationStatus" data-width="100%">
									<option value="1">Published</option>
									<option value="0">Unpublished</option>
								</select>
							</div>
						</div>
						<div class="col-md-8 col-md-offset-2 col-sm-12" id="sliderImage">
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="image" class="file-input-ajax" accept="image/*">
								<span class="help-block text-warning">Insert a Slider Image</span>
							</div>
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /slider Item Update modal -->



<!-- Delete slider Item Model -->
<div id="slider_delete_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Delete Slider Info</h5>
			</div>
			<form action="{{ route('slider.delete') }}" method="POST">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						Your Slider Will be Deleted Permanently.
					</div>
					<div class="row">
						<input type="hidden"  name="sliderId">
						<div class="col-md-6 col-md-offset-3">
							<label>Admin password</label>
							<input type="password" name="password" class="form-control">
							<span class="help-block">For Security Purpose, Enter Your Password</span>
						</div>
					</div>	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Delete Slider Item Model -->



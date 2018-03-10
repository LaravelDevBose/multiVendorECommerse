
<!-- Logo Insert modal -->
<div id="logo_insert_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Insert Logo Information</h5>
			</div>
			<div class="modal-content">
				
			</div>
			<form action="{{ route('logo.store') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="alert alert-info" role="alert">
						If You Save This Logo As Published, Then Previous Logo will be Unpublished
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Tag Line: <span class="text-danger">*</span></label>
								<input type="text" name="tagLine" maxlength="50" required class="form-control" placeholder="Enter Tag Line (Max 50 characters)">
								<span class="help-block text-primary">Enter Tag Line (Max 50 characters) </span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label> Publication:  <span class="text-danger">*</span></label>
								<select class="bootstrap-select" required name="publicationStatus" data-width="100%">
									<option value="0">Unpublished</option>
									<option value="1">Published</option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="logo" class="file-input-ajax" required accept="image/*">
								<span class="help-block">Upload Logo as (jpeg,png) Format</span>
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
<!-- /Logo Item Insert modal -->

<!-- Logo Item Update modal -->
<div id="logo_edit_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Logo Information</h5>
			</div>
			<form action="{{ route('logo.update') }}" method="POST"  enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						If You Update This Logo As Published, Then Previous Logo will be Unpublished
					</div>
					<div class="row">
						<input type="hidden" id="logoId" name="logoId">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Tag Line: </label>
								<input type="text" name="tagLine" id="tagLine" class="form-control" maxlength="50" required placeholder="Enter Tag Line (Max 50 characters)">
								<span class="help-block">Enter Tag Line (Max 50 characters)</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label> Publication: </label>
								<select class="form-control"  name="publicationStatus"  required data-width="100%">
									<option id="unpublish" value="0">Unpublished</option>
									<option id="publish" value="1" >Published</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
								<img src="" id="logoImage" class="img-responsive img-rounded" >
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="logo" class="file-input-ajax"  accept="image/*">
								<span class="help-block">Upload Logo as (jpeg,png) Format</span>
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
<!-- /Logo Item Update modal -->



<!-- Delete Logo Item Modal -->
<div id="logo_delete_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Delete Template Logo</h5>
			</div>
			<form action="{{ route('logo.delete') }}" method="POST">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						Your Logo Will be Deleted Permanently.
					</div>
					<div class="row">
						<input type="hidden" id="logoID" name="logoId">
						<div class="col-md-6 col-md-offset-3">
							<label>Admin password</label>
							<input type="password" name="password" required class="form-control">
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
<!-- /Delete Logo Item Model -->



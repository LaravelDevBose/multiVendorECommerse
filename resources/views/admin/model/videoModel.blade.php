
<!-- Gift Item Insert modal -->
<div id="video_insert_modal" class="modal fade-lg">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Insert Gift Item</h5>
			</div>
			<form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Video Title: </label>
								<input type="text" name="videoTitle" class="form-control" required maxlength="20" placeholder="Video Title">
								<span class="help-block text-warning-600">The video Title or Person Name (Max:20 Char)</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Video Owner Shop/Dorpon: </label>
								<select class="bootstrap-select" required name="ownerId" placeholder="Select A Position" data-width="100%">
									<option value="0">Dorpon</option>
									@forelse($shops as $shop)
									<option value="{{ $shop->id }}">{{ ucfirst($shop->shopName) }}</option>
									@empty

									@endforelse
								</select>
								<span class="help-block text-warning-600">Select Youtube Video About Owner </span>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>YouTube Video Url: </label>
								<input type="url" name="videoPath" class="form-control" required   placeholder="YouTube Video Full Url ">
								<span class="help-block text-warning-600">Only Youtube Video is Enable : <a href="https://www.youtube.com/" target="_blank">https://www.youtube.com/</a></span>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Video Title: </label>
								<textarea name="shortNote"  rows="8" cols="3" minlength="10" maxlength="1500" class="form-control maxlength-textarea" placeholder="Enter Short Discription About Video."></textarea>
								
								<span class="help-block text-warning-600">Enter Short Discription About This Video (Max:1500 Char)</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label> Publication: </label>
								<select class="bootstrap-select" required name="status" data-width="100%">
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
								</select>
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
<!-- /Gift Item Insert modal -->

<!-- Gift Item Update modal -->
<div id="video_edit_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Gift Item</h5>
			</div>
			<form action="{{ route('video.update') }}" method="POST"  enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="row">
						<input type="hidden" name="videoId" id="videoId">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Video Title: </label>
								<input type="text" id="videoTitle" name="videoTitle" class="form-control" required maxlength="20" placeholder="Video Title">
								<span class="help-block text-warning-600">The video Title or Person Name (Max:20 Char)</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Video Owner Shop/Dorpon: </label>
								<select class="form-control" required name="ownerId"  id="ownerId"  data-width="100%">
									<option value="0">Dorpon</option>
									@forelse($shops as $shop)
									<option value="{{ $shop->id }}">{{ ucfirst($shop->shopName) }}</option>
									@empty

									@endforelse
								</select>
								<span class="help-block text-warning-600">Select Youtube Video About Owner </span>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>YouTube Video Url: </label>
								<input type="url" id="videoPath" name="videoPath" class="form-control" required   placeholder="YouTube Video Full Url ">
								<span class="help-block text-warning-600">Only Youtube Video is Enable : <a href="https://www.youtube.com/" target="_blank">https://www.youtube.com/</a></span>
							</div>
						</div>

						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Video Title: </label>
								<textarea name="shortNote" id="shortNote"  rows="8" cols="3" minlength="10" maxlength="1500" class="form-control maxlength-textarea" placeholder="Enter Short Discription About Video."></textarea>
								
								<span class="help-block text-warning-600">Enter Short Discription About This Video (Max:1500 Char)</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label> Publication: </label>
								<select class="form-control" id="status" name="status" required data-width="100%">
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
								</select>
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
<!-- /Gift Item Update modal -->



<!-- Delete Gift Item Model -->
<div id="video_delete_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Delate Gift Type</h5>
			</div>
			<form action="{{ route('video.delete') }}" method="POST">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						<b> Warning!</b>All Gift Product Will Unlink.
					</div>
					<div class="row">
						<input type="hidden" id="videoID" name="videoId">
						<div class="col-md-6 col-md-offset-3">
							<label>Current password</label>
							<input type="password" name="password" class="form-control">
							<span class="help-block">For Security Pleass Enter Your Password</span>
						</div>
					</div>	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Delate</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Delete Gift Item Model -->



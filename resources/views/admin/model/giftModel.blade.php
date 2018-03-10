
<!-- Gift Item Insert modal -->
<div id="gift_insert_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Insert Gift Item</h5>
			</div>
			<form action="{{ route('giftType.store') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Gift Title: <span class="text-danger-800">*</span> </label>
								<input type="text" name="giftTitle" class="form-control" placeholder="Gift Title">
								<span class="help-block">Enter Your Gift Type Title</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label> Position: <span class="text-danger-800">*</span></label>
								<select class="bootstrap-select" required name="position" placeholder="Select A Position" data-width="100%">
									@for($a = 1; $a <=10; $a++ )
										@if(in_array($a,$position))
											<option value="{{$a}}" disabled>{{$a}}</option>
										@else
											<option value="{{$a}}">{{$a}}</option>
										@endif
									@endfor
								</select>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label> Publication:<span class="text-danger-800">*</span> </label>
								<select class="bootstrap-select" required name="status" data-width="100%">
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="image" class="file-input-ajax" required accept="image/*">
								<span class="help-block">Insert an Image</span>
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
<div id="gift_edit_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Gift Item</h5>
			</div>
			<form action="{{ route('giftType.update') }}" method="POST"  enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="row">
						<input type="hidden" id="giftId" name="giftId" />
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Gift Title: <span class="text-danger-800">*</span></label>
								<input type="text" name="giftTitle" id="giftTitle" class="form-control" placeholder="Gift Title">
								<span class="help-block">Enter Your Gift Type Title</span>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label> Position: <span class="text-danger-800">*</span></label>
								<select class="form-control" id="position" required name="position"  data-width="100%">
									@for($a = 1; $a <=10; $a++ )
										@if(in_array($a,$position))
											<option value="{{$a}}" disabled>{{$a}}</option>
										@else
											<option value="{{$a}}">{{$a}}</option>
										@endif
									@endfor
								</select>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label> Publication: <span class="text-danger-800">*</span></label>
								<select class="bootstrap-select" id="status" required name="status" data-width="100%">
									<option value="0">Unpublish</option>
									<option value="1" >Publish</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
								<img src="" id="giftImage" class="img-responsive img-rounded" >
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="image" class="file-input-ajax"  accept="image/*">
								<span class="help-block">If You Want to change Image Then Insert an Image</span>
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
<div id="gift_delete_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Delete Gift Type</h5>
			</div>
			<form action="{{ route('giftType.delete') }}" method="POST">{{ csrf_field() }} 
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						Gift Type Will be Deleted !
					</div>
					<div class="row">
						<input type="hidden" id="giftTypeId" name="giftId">
						<div class="col-md-6 col-md-offset-3">
							<label>Current password</label>
							<input type="password" name="password" class="form-control">
							<span class="help-block">For Security Purpose Pleass Enter Your Password</span>
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
<!-- /Delete Gift Item Model -->



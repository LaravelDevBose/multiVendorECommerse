<!-- Product TAg  modal -->
<div id="insert_tag_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Create A New Tag</h5>
			</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<label>Shop Name:</label>
							<input type="text" name="tagTitle" maxlength="20" required class="form-control">
							<span class="help-block text-warning">Enter Tag Title Must Be Unique Name Max:20char</span>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<textarea name="description"  rows="5" cols="3" maxlength="200" class="form-control maxlength-textarea" placeholder="Enter Tag Short Discription in Max 150 Char"></textarea>
								<span class="help-block text-warning">Enter Tag Short Discription in Max 150 Char</span>
							</div>
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button  class="btn btn-success tag-store">Save</button>
				</div>
		</div>
	</div>
</div>
<!-- /Product Tag modal -->


<!-- Product Primary Color modal -->
<div id="insert_color_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Product Primary Color Insert Form</h5>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-6">
						<label>color Name:</label>
						<input type="text" name="colorName" maxlength="20" required class="form-control">
						<span class="help-block text-warning">Enter Your Product Color</span>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="colorCode" class="form-control colorpicker-flat-input" data-width="100%" data-preferred-format="hex" required >
							<span class="help-block text-warning cleCode">Choose Your valid Color Match With Color Name</span>
						</div>
					</div>
				</div>
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button type="button"  class="btn btn-success priColor-store">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- /Product Primary Color Store modal -->

<!-- Product Secondary Color modal -->
<div id="insert_secColor_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Product Secondary Color Insert Form</h5>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-6">
						<label>color Name:</label>
						<input type="text" name="colorName" maxlength="20" required class="form-control">
						<span class="help-block text-warning">Enter Your Product Color</span>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="colorCode" class="form-control colorpicker-flat-input" data-width="100%" data-preferred-format="hex" required >
							<span class="help-block text-warning cleCode">Choose Your valid Color Match With Color Name</span>
						</div>
					</div>
				</div>
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button type="button"  class="btn btn-success secColor-store">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- /Product Secondary Color Store modal -->
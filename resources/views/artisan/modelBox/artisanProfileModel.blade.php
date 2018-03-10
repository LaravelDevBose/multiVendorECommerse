

<!-- Cover Image Update modal -->
<div id="update_cover_modal" class="modal fade">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Cover Image</h5>
			</div>
			<form action="{{ route('coverImage.change') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }} 
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="bannerImage" class="file-input-ajax" accept="image/*">
								<span class="help-block">Update Your Cover Image Previous Image Will be Destroy</span>
								<span class="help-block">Update Cover Image Must Be Equel or Upper Than 1080*600 px</span>
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
<!-- /Cover Image Update modal -->


<!-- Shop LOgo Image Update modal -->
<div id="update_logo_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Shop Logo </h5>
			</div>
			<form action="{{ route('logo.change') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="file" name="shopLogo" class="file-input-ajax" accept="image/*">
								<span class="help-block">Update Your Logo Previous Logo Will be Destroy</span>
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
<!-- /Shop LOgo Image Update modal -->

<!-- Delete Shop Model -->
<div id="delete_shop" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Delate Shop Request</h5>
			</div>
			<form action="{{ route('shop.delete.request') }}" method="POST">{{ csrf_field() }}
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						<b> Warning!</b>If Your Delete Shop Account Than All Product And Information also Delete.!
					</div>
					<div class="row">
						<div class="form-group">
							<textarea name="deteleReason"  rows="10" cols="3" minlength="10" maxlength="500" class="form-control maxlength-textarea" placeholder="Plesse Tell Us Why You Want Delete Your Shop in 500 Char"></textarea>
							<span class="help-block text-primary-600">Plesse Tell Us Why You Want Delete Your Shop in 500 Char</span>
						</div>
						<div class="col-md-6 col-md-offset-3">
							<label>Current password</label>
							<input type="password" name="admin_password" required  minlength="6" class="form-control">
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
<!-- /Delete Shop Model -->


<!-- Shop Address modal -->
<div id="modal_address" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Shop Address Update Form</h5>
			</div>
			<form action="{{ route('update.shopAddress') }}" method="POST" name="shopAddress">{{ csrf_field() }}
				<div class="modal-body">

					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label>House No :</label>
								<input type="text" name="houseNo" value="{{ (isset($shopAdress->houseNo)?$shopAdress->houseNo:' ')}}"  class="form-control">
							</div>
							<div class="col-md-6">
								<label>Road No :</label>
								<input type="text" name="roadNo" value="{{(isset($shopAdress->roadNo)?$shopAdress->roadNo:' ') }}" class="form-control">
							</div>

						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label>Block # :</label>
								<input type="text" name="block" value="{{ (isset($shopAdress->block)?$shopAdress->block:' ')}}" class="form-control">
							</div>
							<div class="col-md-6">
								<label>Area Name :</label>
								<input type="text" name="areaName" value="{{(isset($shopAdress->areaName)?$shopAdress->areaName:' ')}}" class="form-control">
							</div>

						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
	                            <label>Division :</label>
	                            <select class="select" name="divisionId">
									@forelse($divisions as $division)
										<option value="{{ $division->id }}">{{ $division->areaName }}</option>
									@empty

									@endforelse
	                            </select>
							</div>

							<div class="col-md-4">
								<label>District :</label>
								<select class="select" name="districtId">
									@if(isset($shopAdress->districtId))
										@forelse($districts as $district)
											<option value="{{ $district->id }}">{{ $district->areaName }}</option>
										@empty

										@endforelse

									@endif

								</select>
							</div>

							<div class="col-md-4">
								<label>District :</label>
								<select class="select" name="areaId">
									@if(isset($shopAdress->areaId))
										@forelse($areas as $area)
											<option value="{{ $area->id }}">{{ $area->areaName }}</option>
										@empty
										@endforelse

									@endif
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
<!-- /Shop Address modal -->


<!-- About Shop modal -->
<div id="modal_about" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">About Shop Update Form</h5>
			</div>
			<form action="{{ route('update.aboutShop')}}" method="POST">{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea name="aboutShop"  rows="10" cols="3" minlength="10" maxlength="2500" class="form-control maxlength-textarea" placeholder="Enter Your About Shop Information.">{{ $shopInfo->aboutShop }}</textarea>
								<span class="help-block">Max 2500 Characters</span>
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
<!-- /About Shop modal -->

<!-- Return Policy modal -->
<div id="modal_return" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-teal-300">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Return Policy Update Form</h5>
			</div>

			<form action="{{ route('update.returnPolicy')}}" method="POST">{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea name="returnPolicy"  rows="10" cols="3" minlength="10" maxlength="2500" class="form-control maxlength-textarea" placeholder="Enter Your Shop Return Policy Details.">{{ $shopInfo->returnPolicy }}</textarea>
								<span class="help-block">Max 2500 Characters</span>
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
<!-- /Return Policy modal -->

<!-- Shipping Policy modal -->
<div id="modal_shipping" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Shipping Policy Update Form</h5>
			</div>
			<form action="{{route('update.sippingPolicy')}}" method="POST">{{ csrf_field() }}
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea name="shippingPolicy"  rows="10" cols="3" minlength="10" maxlength="2500" class="form-control maxlength-textarea" placeholder="Enter Your Shipping Policy Details..">{{ $shopInfo->shippingPolicy }}</textarea>
								<span class="help-block">Max 2500 Characters</span>
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
<!-- /Shipping Shop modal -->

<!-- Shop name Change modal -->
<div id="modal_shop_name" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Shop Name</h5>
			</div>
			<form action="{{ route('shop.name.change') }}" method="POST">{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<label>Shop Name:</label>
							<input type="text" name="shopName" value="{{ $shopInfo->shopName }}" required class="form-control">
							<span class="help-block">Enter Your Shop Name Must Be Unique Name</span>
						</div>
					
						<div class="col-md-6 col-md-offset-3">
							<label>Current password</label>
							<input type="password" name="admin_password" required  class="form-control">
							<span class="help-block">Enter Your Current Password</span>
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
<!-- /Shop name Change modal -->

<!-- Shop Email Change modal -->
<div id="modal_email" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Shop Email</h5>
			</div>
			<form action="{{route('shop.email.change')}}" method="POST" >{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<label>Shop Email:</label> 
							<input type="email"  name="shopEmail" value="{{ $shopInfo->shopEmail }}" required  class="form-control">
							<span class="help-block">Enter Your Shop Email Must Be Unique Name</span>
						</div>
					
						<div class="col-md-6 col-md-offset-3">
							<label>Current password</label>
							<input type="password" name="admin_password"  required class="form-control">
							<span class="help-block">Enter Your Current Password</span>
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
<!-- /Shop Email Change modal -->

<!-- Shop Artisan View Name Change modal -->
<div id="modal_custom_artisan_name" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Update Shop Artisan Custrom Name</h5>
			</div>
			<form action="{{route('artisan.view.name')}}" method="POST" >{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<label>Artisan Custrom Name:</label> 
							<input type="text"  name="shopDetailsFour" value="{{ $shopInfo->shopDetailsFour }}" required  class="form-control">
							<span class="help-block">Enter Your Shop Email Must Be Unique Name</span>
						</div>
					
						<div class="col-md-6 col-md-offset-3">
							<label>Current password</label>
							<input type="password" name="admin_password"  required class="form-control">
							<span class="help-block">Enter Your Current Password</span>
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
<!-- /Shop Artisan View NameChange modal -->



<!-- Insert Modarator Model -->
<div id="insert_modarator" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content" id="create-item">
			<div class="modal-header bg-success">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Insert Moderator Account</h5>
			</div>
			<form action="{{ route('modarator.store') }}" method="POST">{{ csrf_field() }}
				<div class="modal-body">

					<div class="row">
						<div class="col-md-4">
							<label>Moderator Name:</label> 
							<input type="text" name="name" value="{{ old('name') }}" placeholder="Moderator Name" class="form-control" required>
							<span>.</span>
						</div>
					
						<div class="col-md-5">
							<label>Email Address</label>
							<input type="email"  name="email" value="{{ old('email') }}" placeholder="shop@gmail.com" class="form-control" required>
						</div>
						<div class="col-md-3">
							<label>Phone No.</label>
							<input type="number" name="phoneNo" value="{{ old('phoneNo') }}"  placeholder="01712345678" class="form-control" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Password</label>
							<input type="password" name="password" placeholder="Enter new password" class="form-control" required>
							<span class="help-block"></span>
						</div>

						<div class="col-md-6">
							<label>Repeat password</label>
							<input type="password" name="password_confirmation" placeholder="Repeat new password" class="form-control" required>
							<span class="help-block"></span>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
                            <label>Acess Type :</label>
                            <select class="select" name="authority" required value="{{ old('authority') }}">
                                
                                <option value="2">Admin</option> 
                                <option value="3">Editor</option>  
                            </select>
						</div>

						<div class="col-md-6">
							<label>Your Password</label>
							<input type="password" name="admin_password" placeholder="Your Password" required class="form-control">
							<span class="help-block">For Security Pleass Enter Your Password</span>
						</div>
					</div>
						
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success crud-submit">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Insert Modarator Model -->


<!-- Delete Modarator Model -->
<div id="delete_modarator" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Delate Moderator Account</h5>
			</div>
			<form action="{{ route('modarator.delate') }}" method="POST">{{ csrf_field() }}
				<div class="modal-body">
					<div class="alert alert-warning" role="alert">
						<b> Warning!</b> Are You Sure Went To Delete <b id="modarator_name" class="text-uppercase"></b> Account.
					</div>
					<div class="row">
						<input type="hidden" id="modaraterId" name="modaraterId" >
						<div class="col-md-6 col-md-offset-3">
							<label>Your password</label>
							<input type="password" name="admin_password" placeholder="Your Password" required class="form-control">
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
<!-- /Delete Modarator Model -->




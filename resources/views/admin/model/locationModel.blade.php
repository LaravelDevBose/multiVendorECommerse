
<!-- Gift Item Insert modal -->
<div id="location_insert_modal" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Insert Location Information</h5>
            </div>
            <form action="{{ route('location.store') }}" method="POST">{{ csrf_field() }}

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Division : </label>
                                <select class="select select2-hidden-accessible"  name="divisionId" placeholder="Select A Division" data-width="100%">
                                    <option value="0">Inserting A Division</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->areaName }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> District: </label>
                                <select   name="districtId" placeholder="Select A District" class="select select2-hidden-accessible" data-width="100%">

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-10 col-sm-12">
                            <div class="form-group">
                                <label>Location Name: </label>
                                <input type="text" name="areaName" class="form-control" placeholder="Area Location Name">
                                <span class="help-block">Write Location Area Name</span>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button  class="btn btn-success location-store">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Gift Item Insert modal -->

<!-- Gift Item Update modal -->
<div id="location_edit_modal" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Update Location Information</h5>
            </div>
            <form action="{{ route('location.update') }}" method="POST"> {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="locationId">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Division: </label>
                                <select class="select select2-hidden-accessible" id="divisionId"  name="divisionId" placeholder="Select A Division" data-width="100%">
                                    <option value="0">Inserting A Division</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->areaName }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> District: </label>
                                <select class="select select2-hidden-accessible"   name="districtId" placeholder="Select A District" data-width="100%">
                                    <option value="0">Inserting A Division</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Location Name: </label>
                                <input type="text" name="areaName" class="form-control" placeholder="Gift Title">
                                <span class="help-block">Enter Location Name</span>
                            </div>
                        </div>



                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success location-update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Gift Item Update modal -->



<!-- Delete Gift Item Model -->
<div id="location_delete_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Delate Gift Type</h5>
            </div>

                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <b> Warning!</b>Are You Sure You Went to Delate This..?.
                    </div>
                    <input type="hidden" name="locationId">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger location-delete">Delete</button>
                </div>

        </div>
    </div>
</div>
<!-- /Delete Gift Item Model -->



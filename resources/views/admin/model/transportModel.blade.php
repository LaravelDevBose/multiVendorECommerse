
<!-- transport Item Insert modal -->
<div id="transport_insert_modal" class="modal fade">

    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Insert Transportion Criteria Information</h5>
            </div>
            <form action="{{ route('transport.store') }}" method="POST">{{ csrf_field() }}

                <div class="modal-body">
                    <input type="hidden" name="transportType">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text" name="transportTitle" required class="form-control" maxlength="80" placeholder="Write Transportion Title (Max 80 characters)">
                                <span class="help-block">Write Transportion Title (Max 80 characters)</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Cart Weight(Kg): </label>
                                <input type="number" name="cartWeight" required class="form-control" placeholder="Cart Weight in Kg">

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Transport Charge(Tk.): </label>
                                <input type="number" name="price" required class="form-control" placeholder="Transportion Charge in Taka">
                                <span class="help-block">Enter Transportion Charge in Taka</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Transport Time: </label>
                                <input type="number" name="transportTime" required class="form-control" placeholder="Transportion Time">
                                <span class="help-block">Enter Transportion Time</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Time Period: </label>
                                <select name="timePeriod" required placeholder="Select Time Period" class="select select2-hidden-accessible" data-width="100%">
                                    <option value="1">Minutes</option>
                                    <option value="2">Hours </option>
                                    <option value="3">Days</option>
                                    <option value="4">Weeks</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-2">
                            <div class="form-group">
                                <label>Transport Location: </label>
                                <select multiple name="areaIds[]"  required placeholder="Select your Transport Locations" class="select select2-hidden-accessible" data-width="100%">
                                    @forelse($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->areaName }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-2">
                            <div class="form-group">
                                <label> Short Description : </label>
                                <textarea rows="5" cols="3" name="details" maxlength="250" required class="form-control maxlength-textarea" placeholder="Write about Transportion Description (Max 250 characters)"></textarea>
                                <span class="help-block">Write about Transportion Description (Max 250 characters)</span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label> Zone Type: </label>
                                <select name="zoneType" required placeholder="Select a Transportion Zone Type" class="select select2-hidden-accessible" data-width="100%">
                                    <option value="1">Active Transportion Zone</option>
                                    <option value="0">No Transportion Zone</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label> Status : </label>
                                <select name="status" required placeholder="Select Transport Status" class="select select2-hidden-accessible" data-width="100%">
                                    <option value="1">Published</option>
                                    <option value="0">Un-Published</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success transport-store">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /transport Item Insert modal -->


<!-- transport Item Insert modal -->
<div id="transport_edit_modal" class="modal fade">

    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Update Transportion Criteria Information</h5>
            </div>
            <form action="{{ route('transport.update') }}" method="POST">{{ csrf_field() }}

                <div class="modal-body">
                    <input type="hidden" name="transportId">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text" name="transportTitle" required class="form-control" maxlength="80" placeholder="Write Transportion Title ( Max 80 characters)">
                                <span class="help-block">Write Transportion Title ( Max 80 characters)</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Cart Weight(Kg): </label>
                                <input type="number" name="cartWeight" required class="form-control" placeholder="Cart Weight in Kg">

                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Transport Charge(Tk.): </label>
                                <input type="number" name="price" required class="form-control" placeholder="Transportion Charge in Taka">
                                <span class="help-block">Enter Transportion Charge in Taka </span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Transport Time: </label>
                                <input type="number" name="transportTime" required class="form-control" placeholder="Transportion Time">
                                <span class="help-block">Enter Transportion Time</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label> Time Period: </label>
                                <select name="timePeriod" id="timePeriod" required placeholder="Select Time Period" class="form-control" data-width="100%">
                                    <option value="1">Minutes</option>
                                    <option value="2">Hours </option>
                                    <option value="3">Days</option>
                                    <option value="4">Weeks</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-2">
                            <div class="form-group">
                                <label> Transport Location: </label>
                                <select multiple name="areaIds[]" id="areaIds"  required placeholder="Select your Transportion Locations" class="select select2-hidden-accessible" data-width="100%">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-2">
                            <div class="form-group">
                                <label> Short Description : </label>
                                <textarea rows="5" cols="3" name="details" maxlength="250" required class="form-control maxlength-textarea" placeholder="Write Short Description in 250 chars."></textarea>
                                <span class="help-block">Write about Transportion Description (Max 250 characters)</span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label> Zone Type: </label>
                                <select name="zoneType"  id="zoneType"  required placeholder="Select a Zone Type" class="select select2-hidden-accessible" data-width="100%">
                                    <option value="1">Active Transport Zone</option>
                                    <option value="0">No Transport Zone</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label> Status : </label>
                                <select name="status" required placeholder="Select Transport Status" class="select select2-hidden-accessible" data-width="100%">
                                    <option value="1">Published</option>
                                    <option value="0">Un-Published</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success transport-store">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /transport Item Insert modal -->




<!-- Delete transport Item Model -->
<div id="transport_delete_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Delete Transportion Criteria</h5>
            </div>

            <form action="{{ route('transport.delete') }}" method="POST">{{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        If Delete This Transportion Criteria, It Will be Deleted For Ever.
                    </div>
                    <input type="hidden" name="transportId">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger transport-delete">Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Delete transport Item Model -->



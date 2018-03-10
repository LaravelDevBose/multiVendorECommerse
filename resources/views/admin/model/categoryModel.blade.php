<!-- Category Item Insert modal -->
<div id="category_insert_modal" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Insert Category Item Information</h5>
            </div>
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" >{{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Main Category: <span class="text-danger">*</span></label>
                                <select name="mainCatId" id="mainCatId"    class="select">
                                    <option value="0">Select A Main Category</option>
                                    @forelse($mainCategoris as $mainCategory)
                                        <option  value="{{ $mainCategory->id }}">{{ $mainCategory->categoryName}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub Category Name:</label>
                                <select name="secondCatId" id="secondCatId" data-placeholder="Select Sub Category Name"  class="select">
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="content-group">
                                <label>Category Name:<span class="text-danger">*</span></label>
                                <input type="text" name="categoryName" value="{{ old('categoryName') }}" required class="form-control maxlength-options" maxlength="50" placeholder="Enter Category Name (Max 50 characters)">
                                <span class="help-block">Enter Category Name (Max 50 characters)r</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Category Position: <span class="text-danger">*</span></label>
                                <select class="select" required name="position" data-width="100%">
                                    @for($a = 1; $a <=10; $a++ )
                                        @if(in_array($a,$position))
                                            <option value="{{$a}}" disabled>{{$a}}</option>
                                        @else
                                            <option value="{{$a}}">{{$a}}</option>
                                        @endif
                                    @endfor

                                </select>
                                <span class="help-block">Select A Category Position</span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Publication: </label>
                                <select class="select" required name="status" data-width="100%">
                                    <option value="1">Publish</option>
                                    <option value="0">Unpublish</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" id="catImage">
                            <div class="form-group" >
                                <input type="file" name="image"  class="file-input-ajax" required accept="image/*">
                                <span class="help-block">Insert Main Category Menu Image Only</span>
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
<!-- /Category Insert modal -->

<!-- Category Edit modal -->
<div id="category_edit_modal" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Insert Category Item Information</h5>
            </div>
            <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="categoryId">
                            <div class="form-group">
                                <label>Select Main Category: <span class="text-danger">*</span></label>
                                <select name="mainCatId" id="mainCatIdEdit"    class="select select2-hidden-accessible">
                                    <option value="0">Select A Main Category</option>
                                    @forelse($mainCategoris as $mainCategory)
                                        <option  value="{{ $mainCategory->id }}">{{ $mainCategory->categoryName}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub Category Name:</label>
                                <select name="secondCatId" id="secondCatIdEdit" data-placeholder="Select Sub Category Name"  class="select select2-hidden-accessible">
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="content-group">
                                <label>Category Name:<span class="text-danger">*</span></label>
                                <input type="text" name="categoryName" value="{{ old('categoryName') }}" required class="form-control maxlength-options" maxlength="50" placeholder="Enter Category Name (Max 50 characters)">
                                <span class="help-block">Enter Category Name (Max 50 characters) </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Category Position: <span class="text-danger">*</span></label>
                                <select class="select" required name="position" data-width="100%">

                                </select>
                                <span class="help-block">Select A Category Position</span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Publication: </label>
                                <select class="form-control" required name="status"  id="statusEdit" data-width="100%">
                                    <option value="1">Publish</option>
                                    <option value="0">Unpublish</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" >
                            <div class="form-group" >
                                <img id="mainCatImage" style="height: 250px; width: 100%;">
                            </div>
                        </div>

                        <div class="col-md-12" id="catImageedit">

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



<!-- Delete Gift Item Model -->
<div id="category_delete_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Delete Product Category</h5>
            </div>
            <form action="{{ route('category.delete') }}" method="POST" >{{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        Do You Want to Delete This Category ? Delete All Products of this Category First!
                    </div>
                    <input type="hidden" name="categoryId">
                    <div class="col-md-6">
                        <div class="content-group">
                            <label>Password:<span class="text-danger">*</span></label>
                            <input type="password" name="password"  required class="form-control maxlength-options" minlength="6" placeholder="Enter Admin Password">
                            <span class="help-block">For Security Purpose Enter Your Password</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger location-delete">Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /Delete Gift Item Model -->
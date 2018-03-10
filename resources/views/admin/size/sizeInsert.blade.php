@extends('admin.master')

@section('title')
    Size Insert
@endsection

@section('asset')
    <!-- Theme JS files -->
    {{-- input Type custom --}}
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/inputs/maxlength.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/form_layouts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/form_controls_extended.js') }}"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


    <!-- /theme JS files -->
@endsection

@section('content')
    <?php $k=1;?>
    <!-- Content area -->
    <div class="content">
        @include('admin.includes.message')
        <form action="{{ route('size.store')}}" method="POST" id="sizeInsert"> {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-12 col-md-offset-2 col-lg-offset-2">
                    <!-- Form validation -->

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Product Size Information</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="reload"></a></li>
                                </ul>
                            </div>
                        </div><hr>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="content-group">
                                        <label>Enter Size Title:<span class="text-danger">*</span></label>
                                        <input type="text" name="sizeTitle" value="{{ old('sizeTitle') }}" required class="form-control maxlength-options" maxlength="20" placeholder="Enter Size Title">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Publication Status:  <span class="text-danger">*</span></label>
                                        <select name="status" data-value="{{ old('status') }}"   data-placeholder="Select Publication Status"  class="select">
                                            <option value="1">Publish</option>
                                            <option value="0">Un-Publish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Size Description:</label>
                                        <textarea rows="3" cols="3" name="details"  maxlength="250" class="form-control maxlength-textarea" placeholder="Product Size Description (Max 250 Characters)">{{ old('details') }}</textarea>
                                        <span class="help-block">Write Product Size Description (Max 250 Characters)</span>
                                    </div>
                                </div>


                            </div>

                            <div class="panel-heading">
                                <label>Size Particular Info:<span class="text-danger">*</span></label>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="meas_field">
                                        <tr>
                                            <td style="width:25%;"><input type="text" required name="sizeFileName[]"  placeholder="Enter Field Name" class="form-control name_list"  /></td>
                                            <td><input type="text" name="sizeData[]" step="0.01" required  placeholder="Enter Field Value" class="form-control name_list"  /></td>
                                            <td style="width:10%;"><button type="button" name="add" id="add" class="btn btn-success"><i class="icon-plus2"></i></button></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                            <div class="row" id="cat_field">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Main Category: <span class="text-danger">*</span></label>
                                            <select name="mainCatId[]" id="mainCatId1" disabled  required  class="select">
                                                <option value="">Select A Main Category</option>
                                                @forelse($mainCategoris as $mainCategory)
                                                    <option  value="{{ $mainCategory->id }}">{{ $mainCategory->categoryName}}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sub Category Name:  <span class="text-danger">*</span></label>
                                            <select name="secondCatId[]" id="secondCatId1"   data-placeholder="Select Sub Category Name"  class="select">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select 3rd Category:  <span class="text-danger">*</span></label>
                                            <select name="thirdCatId[]"  data-placeholder="Select 3rd Category"  id="thirdCatId1"  class="select">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="1" class="btn btn-success add-cat"><i class="icon-plus2"></i></button>
                                        <button type="button" id="1" class="btn btn-primary edit-cat"><i class="icon-pencil7"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <a href="{{ route('sizes') }}" class="btn btn-danger btn-block text-uppercase"><i class="icon-arrow-left16 position-left"> CLOSE FORM</i></a>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <button type="submit" class="btn btn-success btn-block size-submit">Submit form <i class="icon-arrow-right16 position-right"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /form validation -->
                </div>

            </div>
        </form>
    </div>

    <script type="text/javascript" src="{{ asset('public/artisan/ajex/sizeCrud.js') }}"></script>

    <script>
        var j=1;
        $('.add-cat').click(function(){

            j++;
            var rows = '<div class="col-md-12" id="cat'+j+'">\n' +
'                                    <div class="col-md-4">\n' +
'                                        <div class="form-group">\n' +
'                                            <label>Select Main Category: <span class="text-danger">*</span></label>\n' +
'                                            <select name="mainCatId[]" id="mainCatId'+j+'" disabled  required  class="form-control">\n' +
'                                                <option value="">Select A Main Category</option>\n' +
'                                                @forelse($mainCategoris as $mainCategory)\n' +
'                                                    <option  value="{{ $mainCategory->id }}">{{ $mainCategory->categoryName}}</option>\n' +
'                                                @empty\n' +

'                                                @endforelse\n' +
'                                            </select>\n' +
'                                        </div>\n' +
'                                    </div>\n' +
'                                    <div class="col-md-3">\n' +
'                                        <div class="form-group">\n' +
'                                            <label>Sub Category Name:</label>\n' +
'                                            <select name="secondCatId[]" id="secondCatId'+j+'"  data-placeholder="Select Sub Category Name"  class="form-control">\n' +
'                                            </select>\n' +
'                                        </div>\n' +
'                                    </div>\n' +
'                                    <div class="col-md-3">\n' +
'                                        <div class="form-group">\n' +
'                                            <label>Select 3rd Category:</label>\n' +
'                                            <select name="thirdCatId[]"  data-placeholder="Select 3rd Category"  id="thirdCatId'+j+'"  class="form-control">\n' +
'                                            </select>\n' +
'                                        </div>\n' +
'                                    </div>\n' +
'                                    <div class="col-md-2">\n' +
'                                        <button type="button" id="'+j+'" class="btn btn-primary edit-cat"><i class="icon-pencil7"></i></button><button type="button" name="remove" id="'+j+'" class="btn btn-danger cat_remove"><i class="icon-trash"></i></button>\n' +
'                                    </div>\n' +
'                                </div>';

            $('#cat_field').append(rows);
        });



    </script>
@endsection




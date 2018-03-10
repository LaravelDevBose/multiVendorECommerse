@extends('admin.master')

@section('title')
 Product-Colors
@endsection

@section('asset')
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/pickers/color/spectrum.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/picker_color.js') }}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')

    <div class="content">

        @include('admin.includes.message')
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Products Primary Colors Information</h5>
                        <div class="heading-elements">
                            <button type="button" class="btn btn-success btn-sm color-model" data-toggle="modal" id="1" data-target="#color_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Primary Color</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Color View</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            </thead>

                            <tbody id="priColor">
                            @forelse($primaryColors as $primaryColor)
                                <tr id="1">
                                    <td>{{ $primaryColor->colorName }}</td>
                                    <td>{{ $primaryColor->colorCode }}</td>
                                    <td><div class="col-md-1" style=" height: 30px; background-color:{{ $primaryColor->colorCode }}"></div></td>
                                    <td data-id="{{ $primaryColor->id }}">
                                        <button data-toggle="modal" data-target="#color_edit_modal" title="Edit"  class="btn btn-primary btn-sm edit-color"><i class="icon-pencil7"></i></button>
                                        <button data-toggle="modal" data-target="#color_delete_modal" title="Delete" class="btn btn-danger btn-sm remove-color"><i class="icon-bin"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4" class="text-center text-info-600">No Primary Colors Found </th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Products Secondary Colors Information</h5>
                        <div class="heading-elements">
                            <button type="button" class="btn btn-success btn-sm color-model" data-toggle="modal" id="0" data-target="#color_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Secondary Color</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Color View</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            </thead>

                            <tbody id="secColor">
                            @forelse($secondaryColors as $secondaryColor)
                                <tr id="0">
                                    <td>{{ $secondaryColor->colorName }}</td>
                                    <td>{{ $secondaryColor->colorCode }}</td>
                                    <td><div class="col-md-1" style="height: 30px; background-color:{{ $secondaryColor->colorCode }}"></div></td>
                                    <td data-id="{{ $secondaryColor->id }}">
                                        <button data-toggle="modal" data-target="#color_edit_modal"  class="btn btn-primary btn-sm edit-color" title="Edit"><i class="icon-pencil7"></i></button>
                                        <button data-toggle="modal" data-target="#color_delete_modal" class="btn btn-danger btn-sm remove-color" title="Delete"><i class="icon-bin"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="4" class="text-center text-info-600">No Secondary Colors Found</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

    @include('admin.model.colorModel')

    <script src="{{ asset('public/artisan/ajex/productColorCrud.js') }}"></script>
@endsection
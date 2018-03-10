@extends('admin.master')

@section('title')
    Material-View
@endsection

@section('asset')
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')

    <div class="content">

        @include('admin.includes.message')
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Products Material Information</h5>
                        <div class="heading-elements">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#material_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Product Material</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>Material Name</th>
                                <th>Description</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($materials as $material)
                                <tr>
                                    <td>{{ $material->materialName }}</td>
                                    <td>{{ $material->details }}</td>
                                    <td data-id="{{ $material->id }}">
                                        <button data-toggle="modal" data-target="#material_edit_modal" title="Edit" class="btn btn-primary btn-sm edit-item"><i class="icon-pencil7"></i></button>
                                        <button data-toggle="modal" data-target="#material_delete_modal" title ="Delete" class="btn btn-danger btn-sm remove-item"><i class="icon-bin"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="3" class="text-center text-info-600">No Materials Inserted Now</th>
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

    @include('admin.model.materialsModel')

    <script src="{{ asset('public/artisan/ajex/productMatarielCrud.js') }}"></script>
@endsection
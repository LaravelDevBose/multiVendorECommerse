@extends('admin.master')

@section('title')
    Location
@endsection

@section('asset')
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/form_select2.js') }}"></script>
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
                        <h5 class="panel-title">Location Information</h5>
                        <div class="heading-elements">
                            <button type="button" class="btn btn-success btn-sm color-model" data-toggle="modal" data-target="#location_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Location</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>Sl No</th>
                                <th>Location Name</th>
                                <th>Division Name</th>
                                <th>Districts Name</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1;?>
                            @forelse($divisions as $division)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $division->areaName }}</td>
                                    <td> </td>
                                    <td> </td>
                                    <td data-id="{{ $division->id }}">
                                        <button data-toggle="modal" data-target="#location_edit_modal"  class="btn btn-primary btn-sm edit-division">Edit</button>

                                    </td>
                                </tr>
                                <?php $districts = App\TransportLocation::where('divisionId',$division->id)->where('districtId', null)->latest()->get(); $j=1;?>
                                    @forelse($districts as $district)
                                        <tr>
                                            <td>{{ $i .'.'. $j }}</td>
                                            <td>{{ $district->areaName }}</td>
                                            <td id="{{ $division->id }}">{{ $division->areaName }} </td>
                                            <td> </td>
                                            <td data-id="{{ $district->id }}">
                                                <button data-toggle="modal" data-target="#location_edit_modal"  class="btn btn-primary btn-sm edit-district">Edit</button>

                                            </td>
                                        </tr>
                                        <?php $upazillas  = App\TransportLocation::where('divisionId',$division->id)->where('districtId', $district->id)->latest()->get(); $k=1;?>
                                        @forelse($upazillas as $upazilla)
                                            <tr>
                                                <td>{{ $i .'.'. $j.'.'.$k++ }}</td>
                                                <td>{{ $upazilla->areaName }}</td>
                                                <td id="{{ $division->id }}">{{ $division->areaName }} </td>
                                                <td id="{{ $district->id }}">{{ $district->areaName }}</td>
                                                <td data-id="{{ $upazilla->id }}">
                                                    <button data-toggle="modal" data-target="#location_edit_modal"  class="btn btn-primary btn-sm edit-upazalla">Edit</button>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th colspan="5" class="text-center text-info-600">This District not found any Upozilla or Thana </th>
                                            </tr>
                                        @endforelse

                                        <?php $j++ ;?>
                                    @empty
                                        <tr>
                                            <th colspan="5" class="text-center text-info-600">This Division not found any District </th>
                                        </tr>
                                    @endforelse
                                <?php $i++ ;?>
                            @empty
                                <tr>
                                    <th colspan="5" class="text-center text-info-600">No Primary Colors Found </th>
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

    @include('admin.model.locationModel')
    <script src="{{ asset('public/artisan/ajex/locationCrud.js') }}"></script>



@endsection
@extends('admin.master')

@section('title')
 Delivery
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
                        <h5 class="panel-title">Delivery Criteria Information</h5>
                        <div class="heading-elements">
                            <button type="button" class="btn btn-success btn-sm transport-model" data-toggle="modal" id="1" data-target="#transport_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Delivery</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>Sl No</th>
                                <th>Delivery Title</th>
                                <th>Delivery Time</th>
                                <th>Cart Weight</th>
                                <th>Delivery Price</th>
                                <th>Zone Type</th>
                                <th>Delivery Area</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1;?>
                            @forelse($deliverys as $delivery)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $delivery->transportTitle }}</td>
                                    <td id="{{ $delivery->transportTime }}">
                                        {{ $delivery->transportTime }}
                                        <small id="{{ $delivery->timePeriod }}">
                                            @if($delivery->timePeriod == 1)Mints @elseif($delivery->timePeriod == 2)Hours @elseif($delivery->timePeriod == 3)Days @elseif($delivery->timePeriod == 4)Weeks @endif
                                        </small>
                                    </td>
                                    <td id="{{ $delivery->cartWeight }}">{{ $delivery->cartWeight }}K.G.</td>
                                    <td>&#2547; <span>{{ number_format($delivery->price)}}</span></td>
                                    <td>
                                        @if($delivery->zoneType == 1)
                                            <span id="1" class="label bg-success-300">Active Delivery Zone</span>
                                        @else
                                            <span id="0" class="label bg-danger-300">No Delivery Zone</span>
                                        @endif
                                    </td>
                                    <td id="$delivery->areaIds">
                                        <ul class="list-inline list-inline-separate mb-10">
                                            <?php
                                                $areaIds = explode(',',$delivery->areaIds);
                                                foreach($areaIds as $areaId){
                                                    $areaName = App\TransportLocation::where('id',$areaId)->value('areaName');
                                            ?>
                                            <li><span class="text-muted">{{ ucfirst($areaName) }}</span></li>
                                            <?php }?>
                                        </ul>
                                    </td>
                                    <td>{{ $delivery->details }}</td>

                                    <td>
                                        @if($delivery->status == 1)
                                            <span id="1" class="label bg-success-600">Publish</span>
                                        @else
                                            <span id="0" class="label bg-danger-600">UnPublish</span>
                                        @endif
                                    </td>

                                    <td data-id="{{ $delivery->id }}">
                                        <button data-toggle="modal" data-target="#transport_edit_modal" title="Edit"  class="btn btn-primary btn-sm edit-transport"><i class="icon-pencil7"></i></button>
                                        <button data-toggle="modal" data-target="#transport_delete_modal" title="Delete" class="btn btn-danger btn-sm remove-transport"><i class="icon-bin"></i></button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <th colspan="10" class="text-center text-info-600">No Delivery Criteria Found. </th>
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

    @include('admin.model.transportModel')
    <script src="{{ asset('public/artisan/ajex/transportCrud.js') }}"></script>



@endsection
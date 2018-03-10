@extends('admin.master')

@section('title')
    Pick-Up
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
                            <button type="button" class="btn btn-success btn-sm transport-model" data-toggle="modal" id="0" data-target="#transport_insert_modal"><i class=" icon-plus2 position-left"></i>Insert Pick Up</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>Sl No</th>
                                <th>Pick Up Title</th>
                                <th>Pick Up Time</th>
                                <th>Cart Weight</th>
                                <th>Pick Up Price</th>
                                <th>Zone Type</th>
                                <th>Pick Up Area</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1;?>
                            @forelse($pickUps as $pickUp)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $pickUp->transportTitle }}</td>
                                    <td id="{{ $pickUp->transportTime }}">
                                        {{ $pickUp->transportTime }}
                                        <small id="{{ $pickUp->timePeriod }}">
                                            @if($pickUp->timePeriod == 1)Mints @elseif($pickUp->timePeriod == 2)Hours @elseif($pickUp->timePeriod == 3)Days @elseif($pickUp->timePeriod == 4)Weeks @endif
                                        </small>
                                    </td>
                                    <td id="{{ $pickUp->cartWeight }}">{{ $pickUp->cartWeight }}K.G.</td>
                                    <td>&#2547; <span>{{ number_format($pickUp->price)}}</span></td>
                                    <td>
                                        @if($pickUp->zoneType == 1)
                                            <span id="1" class="label bg-success-300">Active Delivery Zone</span>
                                        @else
                                            <span id="0" class="label bg-danger-300">No Delivery Zone</span>
                                        @endif
                                    </td>
                                    <td id="{{$pickUp->areaIds}}">
                                        <ul class="list-inline list-inline-separate mb-10">
                                            <?php
                                            $areaIds = explode(',',$pickUp->areaIds);
                                            foreach($areaIds as $areaId){
                                            $areaName = App\TransportLocation::where('id',$areaId)->value('areaName');
                                            ?>
                                            <li><span class="text-muted">{{ ucfirst($areaName) }}</span></li>
                                            <?php }?>
                                        </ul>
                                    </td>
                                    <td>{{ $pickUp->details }}</td>

                                    <td>
                                        @if($pickUp->status == 1)
                                            <span id="1" class="label bg-success-600">Publish</span>
                                        @else
                                            <span id="0" class="label bg-danger-600">UnPublish</span>
                                        @endif
                                    </td>

                                    <td data-id="{{ $pickUp->id }}">
                                        <button data-toggle="modal" data-target="#transport_edit_modal" title="Edit"  class="btn btn-primary btn-sm edit-transport"><i class="icon-pencil7"></i></button>
                                        <button data-toggle="modal" data-target="#transport_delete_modal" title="Delete" class="btn btn-danger btn-sm remove-transport"><i class="icon-bin"></i></button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <th colspan="10" class="text-center text-info-600">No Pick Up Criteria Found.</th>
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
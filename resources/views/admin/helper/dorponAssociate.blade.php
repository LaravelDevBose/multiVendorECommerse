@extends('admin.master')

@section('title')
    Dorpon Associate
@endsection

@section('asset')
    <!-- Theme JS files -->
    {{-- input Type custom --}}
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/datatables_sorting.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')
    <div class="content">
        @include('admin.includes.message')
        <div class="row">
            <div class="col-md-12">

                <!-- Complex headers with sorting -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Dorpon Associate Information</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <!-- <li><a data-action="close"></a></li> -->
                            </ul>
                        </div>
                    </div>

                    <table class="table table-bordered datatable-complex-header">
                        <thead>
                        <tr>
                            <th rowspan="2">Personal Information</th>
                            <th colspan="3">Contact Information</th>
                            <th colspan="2">Payment && Shop Info</th>
                            <th rowspan= "2">Action</th>
                        </tr>
                        <tr>
                            <th>Code</th>
                            <th>Phone Number</th>
                            <th>Email Address</th>
                            <th>persent</th>
                            <th>Shop Access</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($shopsInfo as $shopInfo)
                            <tr>
                                <td>
                                    <div class="media-left media-middle">
                                        <a href="#">
                                            <?php
                                            $shopLogo = $shopInfo->shopLogo ;
                                            if(!file_exists($shopLogo)){
                                                $shopLogo = 'public/artisan/assets/images/placeholder.jpg';
                                            }
                                            ?>
                                            <img src="{{ asset( $shopLogo ) }}" class="img-circle img-lg" alt="">
                                        </a>
                                    </div>
                                    <div class="media-left">
                                        <div class=""><a href="#" class="text-default text-bold text-uppercase">{{ $shopInfo->shopName }}</a></div>
                                        <div class="text-muted text-size-small">
                                            <!-- <i class="icon-pushpin border-blue position-left"></i> -->
                                            <span class="icon-pushpin text-size-small text-info "></span>
                                            <?php
                                            $date = new DateTime($shopInfo->created_at);
                                            $joinDate = date_format($date, 'd M Y');
                                            ?>
                                            {{ $joinDate }}
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-semibold text-uppercase">{{ $shopInfo->name }}</span></td>
                                <td>{{ $shopInfo->phoneNo }}</td>
                                <td>{{ $shopInfo->email }}</td>
                                <td>
                                    <?php echo $totalProdut = App\Product::where('ownerId',$shopInfo->id)->count();?>
                                </td>
                                <td>
                                    &#2547; <?php echo $totalSell = App\OrderDetail::where('ownerId',$shopInfo->id)->sum('subTotal');?>
                                </td>
                                <td>
                                    <a href="{{ route('shop.singel.view', $shopInfo->id) }}" title="View Shop" class="btn btn-info btn-sm"><i class="icon-eye"></i></a>
                                    <!-- <button title="Block Shop" class="btn btn-danger btn-sm"><i class="icon-eye-blocked"></i></button> -->
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7">
                                    <span class="text-semibold text-info">No Shop Found ..!</span>
                                </td>
                            </tr>

                        @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- /complex headers with sorting -->

            </div>
        </div>

    </div>

    @include('admin.model.colorModel')

    <script src="{{ asset('public/artisan/ajex/productColorCrud.js') }}"></script>

@endsection
@extends('admin.layouts.app')
@section('content')
    <!--end row-->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Anasayfa</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Siparişler</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header border-0">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm">
                            <h5 class="card-title mb-0">Siparişler</h5>
                        </div>

                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <x-order.order-navbar-filter :url="route('admin.order.completed')"/>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <x-order.order-navbar :active="'completed'"/>
                        <x-order.order-table :orders="$orders"/>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>

@endsection

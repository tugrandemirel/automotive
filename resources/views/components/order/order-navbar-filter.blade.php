@isset($url)
    <form>
        <div class="row g-3">
            <div class="col-xxl-5 col-sm-6">
                <div class="search-box">
                    <input type="text" class="form-control search" name="name" placeholder="Search for order ID, customer, order status or something...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-2 col-sm-6">
                <div>
                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" id="demo-datepicker" placeholder="Select date">
                </div>
            </div>
            <!--end col-->

            @if( $url === route('admin.order.index'))
            <div class="col-xxl-2 col-sm-4">
                <div>
                    <select class="form-control" name="status" id="idStatus">
                        <option value="">Durum</option>
                        <option value="" selected>Hepsi</option>
                        <option value="{{ \App\Enum\Order\OrderStatusEnum::PENDING }}" @selected(request()->get('status') == \App\Enum\Order\OrderStatusEnum::PENDING)>Bekleyen</option>
                        <option  value="{{ \App\Enum\Order\OrderStatusEnum::PROCESSING }}" @selected(request()->get('status') == \App\Enum\Order\OrderStatusEnum::PROCESSING)>Hazırlanan</option>
                        <option  value="{{ \App\Enum\Order\OrderStatusEnum::SHIPPED }}" @selected(request()->get('status') == \App\Enum\Order\OrderStatusEnum::SHIPPED)>Yolda</option>
                        <option  value="{{ \App\Enum\Order\OrderStatusEnum::COMPLETED }}" @selected(request()->get('status') == \App\Enum\Order\OrderStatusEnum::COMPLETED)>Teslim Edilen</option>
                        <option  value="{{ \App\Enum\Order\OrderStatusEnum::CANCELLED }}" @selected(request()->get('status') == \App\Enum\Order\OrderStatusEnum::CANCELLED)>İptal Edilen</option>
                    </select>
                </div>
            </div>
            @endif
            <!--end col-->
            <!--end col-->
            <div class="col-xxl-1 col-sm-4">
                <div class="hstack gap-2 ">
                    <button type="submit" class="btn btn-primary w-100" ><i
                            class="ri-search-line"></i>
                    </button>
                    @if(count(request()->all()) > 0)
                        <button type="button" onclick="location.href = {{ $url }}" class="btn btn-danger w-100" ><i
                                class="ri-delete-bin-5-line"></i>
                        </button>
                    @endif
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>
@endisset

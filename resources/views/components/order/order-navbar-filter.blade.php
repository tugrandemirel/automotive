@php use App\Enum\Order\OrderStatusEnum; @endphp
@isset($url)
    <form id="filterForm">
        <div class="row g-3">
            <div class="col-xxl-5 col-sm-6">
                <div class="search-box">
                    <input type="text" class="form-control search" name="code" placeholder="Sipariş Numarası giriniz">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <!--end col-->
            @if( $url === route('admin.order.index'))
                <div class="col-xxl-2 col-sm-4">
                    <div>
                        <select class="form-control" onchange="document.getElementById('filterForm').submit()"
                                name="status" id="idStatus">

                            <option value="" @selected(is_null(request()->get('status'))) selected>Sipariş Durumu
                            </option>
                            <option
                                value="{{ OrderStatusEnum::PENDING }}" @selected(request()->get('status') == OrderStatusEnum::PENDING->value)>
                                Bekleyen
                            </option>
                            <option
                                value="{{ OrderStatusEnum::PROCESSING }}" @selected(request()->get('status') == OrderStatusEnum::PROCESSING->value)>
                                Hazırlanan
                            </option>
                            <option
                                value="{{ OrderStatusEnum::SHIPPED }}" @selected(request()->get('status') == OrderStatusEnum::SHIPPED->value)>
                                Yolda
                            </option>
                            <option
                                value="{{ OrderStatusEnum::COMPLETED }}" @selected(request()->get('status') == OrderStatusEnum::COMPLETED->value)>
                                Teslim Edilen
                            </option>
                            <option
                                value="{{ OrderStatusEnum::CANCELLED }}" @selected(request()->get('status') == OrderStatusEnum::CANCELLED->value)>
                                İptal Edilen
                            </option>
                        </select>
                    </div>
                </div>
            @endif
            <!--end col-->
            <!--end col-->
            <div class="col-xxl-1 col-sm-4">
                <div class="hstack gap-2 ">
                    <button type="submit" class="btn btn-primary w-100"><i
                            class="ri-search-line"></i>
                    </button>
                    @if(count(request()->all()) > 0)
                        <button type="button" onclick="location.href = '{{ $url }}'" class="btn btn-danger w-100"><i
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

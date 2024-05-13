
<div class="table-responsive table-card mb-1">
    @if($orders->count())
        <table class="table table-nowrap align-middle" id="orderTable">
            <thead class="text-muted table-light">
            <tr class="text-uppercase">
                <th data-sort="id">SİPARİŞ İD</th>
                <th data-sort="code">SİPARİŞ KODU</th>
                <th data-sort="customer_name">AD/ÜNVAN</th>
                <th data-sort="product_name">SİPARİŞ VEREN</th>
                <th data-sort="date">SİPARİŞ TARİHİ</th>
                <th data-sort="amount">ÜRÜN ADEDİ</th>
                <th data-sort="payment">ÖDEME YÖNTEMİ</th>
                <th data-sort="status">SİPARİŞ DURUMU</th>
                <th data-sort="action">İŞLEMLER</th>
            </tr>
            </thead>
            <tbody class="list form-check-all">
            @foreach($orders as $order)
                <tr>
                    <td class="id">#{{ $order?->id ?? '-' }}</td>
                    <td class="code">{{ $order?->code ?? '-' }}</td>
                    <td class="customer_name">
                        {{ $order?->company?->name ??'-' }}
                    </td>
                    <td class="name">
                        {{ $order?->user?->full_name ??'-' }}
                    </td>
                    <td class="date">{{ $order?->created_at?->format('d/m/y') ?? '-' }}</td>
                    <td class="amount">
                        {{ $order?->order_details_count ?? '-' }}
                    </td>
                    <td class="payment_method">
                        <span
                            class="badge bg-{{ $order?->payment_method_color_formatted }}-subtle text-{{ $order?->payment_method_color_formatted }}"
                            data-toggle="tooltip"
                            title="{{ $order?->payment_method_formatted ??'-' }}">
                            {{ $order?->payment_method_formatted ??'-' }}
                        </span>
                    </td>
                    <td class="status">
                        <div class="col-lg-12">
                            <select name="status" data-id="{{ $order?->hashid() }}" id="" class="form-select changeStatus">
                                <option value="{{ \App\Enum\Order\OrderStatusEnum::PENDING }}" @selected($order?->status == \App\Enum\Order\OrderStatusEnum::PENDING)> Alındı</option>
                                <option value="{{ \App\Enum\Order\OrderStatusEnum::PROCESSING }}" @selected($order?->status == \App\Enum\Order\OrderStatusEnum::PROCESSING)>Hazırlanıyor</option>
                                <option value="{{ \App\Enum\Order\OrderStatusEnum::SHIPPED }}" @selected($order?->status == \App\Enum\Order\OrderStatusEnum::SHIPPED)>Yola Çıktı</option>
                                <option value="{{ \App\Enum\Order\OrderStatusEnum::COMPLETED }}" @selected($order?->status == \App\Enum\Order\OrderStatusEnum::COMPLETED)>Tamamlandı</option>
                                <option value="{{ \App\Enum\Order\OrderStatusEnum::CANCELLED }}" @selected($order?->status == \App\Enum\Order\OrderStatusEnum::CANCELLED)>İptal Edildi</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                data-bs-placement="top" title="View">
                                <a href="{{ route('admin.order.show', ['order' => $order->hashid()]) }}" class="text-primary d-inline-block">
                                    <i class="ri-eye-fill fs-16"></i>
                                </a>
                            </li>

                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <x-no-found/>
    @endif
</div>
<div class="d-flex justify-content-end">
    <div class="pagination-wrap hstack gap-2">
        {{ $orders->links() }}
    </div>
</div>
@push('js')
    <script>
        $('.changeStatus').change(function(){
            let dataId = $(this).data('id');
            let status = $(this).val()

            let url = '{{ route('admin.order.status', ['order' => '%%dataId%%']) }}'
            url = url.replace('%%dataId%%', dataId)

            Swal.fire({
                title: 'Sipariş Durumunu Değiştirmek İstediğinize Emin Misiniz?',
                icon: "question",
                text: 'Sipariş durumu değiştirildiği anda ona bağlı olan sipariş detaylarındaki durumlarda değiştirilecektir.',
                confirmButtonColor: "#DD6B55",
                cancelButtonColor: "#4b38b3",
                showCancelButton: true,
                confirmButtonText: "Evet, değiştir!",
                cancelButtonText: "Hayır, vazgeç!",
                reverseButtons: true
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {_token: '{{ csrf_token() }}', status: status},
                        success: function (response) {
                            Swal.fire({
                                title: "Başarılı!",
                                text: response.data.message,
                                icon: "success",
                                confirmButtonText: "Tamam!",
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        },
                        error: function (error) {
                            Swal.fire({
                                title: "Hata!",
                                text: error.message,
                                icon: "error",
                                confirmButtonText: "Tamam!",
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        }
                    })
                } else {
                    // TODO: Burada önceki değer selected olarak getirme işlemi yapılacak
                }
            })
        })
    </script>
@endpush


<div class="table-responsive table-card mb-1">
    @if($orders->count())
        <table class="table table-nowrap align-middle" id="orderTable">
            <thead class="text-muted table-light">
            <tr class="text-uppercase">
                <th data-sort="id">Sipariş ID</th>
                <th data-sort="code">Sipariş Kodu</th>
                <th data-sort="customer_name">Ad/Ünvan</th>
                <th data-sort="product_name">Sipariş Veren</th>
                <th data-sort="date">Sipariş Tarihi</th>
                <th data-sort="amount">Ürün Adet</th>
                <th data-sort="payment">Ödeme Yöntemi</th>
                <th data-sort="status">Sipariş Durumu</th>
                <th data-sort="action">İşlemler</th>
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
                    <td class="date">{{ $order?->created_at ?? '-' }}</td>
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
                        {{ $order?->status_formatted ?? '-' }}
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

<ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'all' ? 'active' : '' }} All py-3" id="All" href="{{ route('admin.order.index') }}"
           role="tab" aria-selected="true">
            <i class="ri-store-2-fill me-1 align-bottom"></i> Siparişler
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'pending' ? 'active' : '' }} All py-3" id="All" href="{{ route('admin.order.pending') }}"
           role="tab" aria-selected="true">
            <i class="ri-draft-fill me-1 align-bottom"></i> Alınan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'processing' ? 'active' : '' }} All py-3" id="All" href="{{ route('admin.order.processing') }}"
           role="tab" aria-selected="true">
            <i class="ri- me-1 align-bottom"></i> Hazırlanan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'shipped' ? 'active' : '' }} py-3 Pickups" id="Pickups"  href="{{ route('admin.order.shipped') }}" role="tab" aria-selected="false">
            <i class="ri-truck-line me-1 align-bottom"></i> Yolda
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'completed' ? 'active' : '' }} py-3 Delivered"  id="Delivered" href="{{ route('admin.order.completed') }}" role="tab" aria-selected="false">
            <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Teslim Edilen
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'cancelled'? 'active' : '' }} py-3 Cancelled" id="Cancelled"  href="{{ route('admin.order.cancelled') }}" role="tab" aria-selected="false">
            <i class="ri-close-circle-line me-1 align-bottom"></i> İptal Edilen
        </a>
    </li>

</ul>

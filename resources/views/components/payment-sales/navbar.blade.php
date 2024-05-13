<ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'sales' ? 'active' : '' }} All py-3" id="All" href="{{ route('admin.finance.show', ['company' => $company?->hashid()]) }}"
           role="tab" aria-selected="true">
            <i class="ri-store-2-fill me-1 align-bottom"></i> Satışlar
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ isset($active) && $active === 'payments' ? 'active' : '' }} All py-3" id="All" href="{{ route('admin.finance.payment',  ['company' => $company?->hashid()]) }}"
           role="tab" aria-selected="true">
            <i class="ri-draft-fill me-1 align-bottom"></i> Ödemeler
        </a>
    </li>
</ul>

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
                        <li class="breadcrumb-item active">Ödemeler</li>
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
                            <h5 class="card-title mb-0">Satışlar ve Ödemeler</h5>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex gap-1 flex-wrap">
                                <a class="btn btn-success add-btn"  data-bs-toggle="modal" data-bs-target="#exampleModalgrid"><i
                                        class="ri-add-line align-bottom me-1"></i> Ödeme Ekle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <h6 class="card-title mb-0">{{ $company?->name }}</h6>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <form id="filterForm">
                            <div class="row g-3">
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control" name="dates" value="{{ request()->get('dates') }}" placeholder="Tarih Aralığı Giriniz">
                                        <i class="ri-calendar-2-fill search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-1 col-sm-4">
                                    <div class="hstack gap-2 ">
                                        <button type="submit" class="btn btn-primary w-100"><i
                                                class="ri-search-line"></i>
                                        </button>
                                        @if(count(request()->all()) > 0)
                                            <button type="button" onclick="location.href = '{{ route('admin.finance.payment',  ['company' => $company?->hashid()]) }}'" class="btn btn-danger w-100"><i
                                                    class="ri-delete-bin-5-line"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                        <x-payment-sales.navbar :active="'payments'" :company="$company"/>
                        <div class="table-responsive table-card mb-1">
                            @if($salesPayments->count())
                                <table class="table table-nowrap align-middle" id="orderTable">
                                    <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th data-sort="code">SİPARİŞ KODU</th>
                                        <th data-sort="created_at">ÖDEME TARİHİ</th>
                                        <th data-sort="description">AÇIKLAMA</th>
                                        <th data-sort="amount">ÜRÜN TUTARI</th>
                                        <th data-sort="payment">ÖDEME YÖNTEMİ</th>
                                        <th data-sort="process">İŞLEMLER</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @foreach($salesPayments as $salesPayment)
                                        <tr>
                                            <td class="payment_method">
                                                <span
                                                    class="badge bg-{{ $salesPayment?->payment_method_color_formatted }}-subtle text-{{ $salesPayment?->payment_method_color_formatted }}"
                                                    data-toggle="tooltip"
                                                    title="{{ $salesPayment?->payment_method_formatted ??'-' }}">
                                                    {{ $salesPayment?->payment_method_formatted ??'-' }}
                                                </span>
                                            </td>
                                            <td class="">{{ $salesPayment?->payment_date->format('Y/m/d') ?? '-' }}</td>
                                            <td class="">{{ $salesPayment?->description ?? '-' }}</td>

                                            <td class="">{{ $salesPayment?->amount ?? 0 }}</td>

                                            <td class="">{{ $salesPayment?->type }}</td>
                                            <td class="">
                                                <a style="cursor: pointer;" class="text-primary d-inline-block edit-item-btn"  data-bs-toggle="modal" data-bs-target="#exampleModalgrid{{$salesPayment?->id}}"><i
                                                        class="ri-pencil-fill align-bottom me-1"></i></a>
                                                <a style="cursor: pointer;" onclick="deleteItem('{{ route('admin.finance.salesPayment.destroy', ['company' => $company?->hashid(), 'salesPayment' => $salesPayment]) }}')"
                                                   class="text-danger d-inline-block remove-item-btn"
                                                >
                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                </a>
                                            </td>
                                        </tr>


                                        <div class="modal fade" id="exampleModalgrid{{ $salesPayment?->id }}" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalgridLabel">Ödeme Ekle</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.finance.salesPayment.update', ['company' => $company?->hashid(), 'salesPayment' => $salesPayment]) }}" method="POST">
                                                            @csrf
                                                            <div class="row g-3">
                                                                <div class="col-xxl-12">
                                                                    <div>
                                                                        <label for="importExcel" class="form-label">Açıklama</label>
                                                                        <input type="text" class="form-control" name="description" value="{{ $salesPayment?->description ?? '-' }}">
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-xxl-12">
                                                                    <div>
                                                                        <label for="importExcel" class="form-label">Ödeme Şekli</label>
                                                                        <input type="text" class="form-control" name="type" value="{{ $salesPayment?->type ?? '-' }}">
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-xxl-12">
                                                                    <div>
                                                                        <label for="importExcel" class="form-label">Tutar</label>
                                                                        <input type="number" class="form-control" min="0" name="amount" value="{{ $salesPayment?->amount ?? '' }}">
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-xxl-12">
                                                                    <div>
                                                                        <label for="importExcel" class="form-label">Ödeme Tarihi</label>
                                                                        <input type="datetime-local" class="form-control" name="payment_date" value="{{ $salesPayment?->payment_date }}">
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-lg-12">
                                                                    <div class="hstack gap-2 justify-content-end">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                                                                        <button type="submit" class="btn btn-primary">Kaydet</button>
                                                                    </div>
                                                                </div><!--end col-->
                                                            </div><!--end row-->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <x-no-found/>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $salesPayments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Ödeme Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.finance.salesPayment.store', ['company' => $company?->hashid()]) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Açıklama</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Ödeme Şekli</label>
                                    <input type="text" class="form-control" name="type">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Tutar</label>
                                    <input type="number" class="form-control" name="amount">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Ödeme Tarihi</label>
                                    <input type="datetime-local" class="form-control" name="payment_date">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function deleteItem(url) {
            Swal.fire({
                title: 'Silmek İstediğinize Emin Misiniz?',
                icon: "question",
                text: 'Silme işleminiz onaylandığı anda bütün bağlı veriler silinecektir.',
                confirmButtonColor: "#DD6B55",
                cancelButtonColor: "#4b38b3",
                showCancelButton: true,
                confirmButtonText: "Evet, sil!",
                cancelButtonText: "Hayır, vazgeç!",
                reverseButtons: true
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {_token: '{{ csrf_token() }}'},
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
                }
            })
        }
    </script>
@endpush

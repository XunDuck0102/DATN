@php use App\Models\Contract; @endphp
@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row d-flex">
                <div class="col-11">
                    <h1 class="h3"> Danh sách hợp đồng</h1>
                </div>
                <div class="col-1">
                    <a class="btn btn-primary" style="margin-bottom: 5px" href="{{ route('contract.create') }}">Thêm
                        mới</a>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <form id="search-form" class="row g-3 mb-4">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">-- Tất cả trạng thái --</option>
                                @foreach(Contract::STATUSES as $key => $label)
                                    <option
                                        value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="customer_id" class="form-select">
                                <option value="">-- Tất cả khách hàng --</option>
                                @foreach($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <div id="result-table">
                        @include('page.contract.contract_table', ['contracts' => $contracts])
                    </div>
                </div>
            </div>
        </div>
    </main>
    @foreach($contracts as $contract)
        <div class="modal fade" id="viewContractModal{{ $contract->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #9e1f1e;">
                        <h5 class="modal-title text-white" id="customerDetailModalLabel">Chi tiết hợp đồng</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Mã HĐ:</strong> {{ $contract->code }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12"><strong>Tên HĐ:</strong> {{ $contract->name }}</div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Trạng thái:</strong> {{ \App\Models\Contract::STATUSES[$contract->status] ?? '---' }}</div>
                            <div class="col-md-6"><strong>Ngày ký:</strong> {{ \Carbon\Carbon::parse($contract->signed_date)->format('d/m/Y') }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Ngày kết thúc:</strong> {{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}</div>
                            <div class="col-md-6"><strong>Khách hàng:</strong> {{ $contract->customer->name ?? '---' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Nhân viên phụ trách:</strong> {{ $contract->staff->name ?? '---' }}</div>
                            <div class="col-md-6">
                                <strong>File hợp đồng:</strong>
                                @if ( $contract->file)
                                    <a href="{{ $contract->file }}" target="_blank">Tải xuống</a>
                                @else
                                    Không có
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <strong>Nội dung hợp đồng:</strong>
                                <div class="p-2 border rounded bg-light mt-1" style="white-space: pre-line;">
                                    {!! nl2br(e($contract->content)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        $(document).on('keyup change', '#search-form input, #search-form select', function () {
            let formData = $('#search-form').serialize();

            $.ajax({
                url: '{{ route("contract.search") }}',
                method: 'GET',
                data: formData,
                success: function (response) {
                    $('#result-table').html(response);
                },
                error: function () {
                    alert('Không thể tải dữ liệu, vui lòng thử lại.');
                }
            });
        });
    </script>

@endsection

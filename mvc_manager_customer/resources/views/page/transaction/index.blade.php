@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row d-flex">
                <div class="col-11">
                    <h1 class="h3"> Danh sách giao dịch</h1>
                </div>
                <div class="col-1">
                    <a class="btn btn-primary" style="margin-bottom: 5px" href="{{ route('transaction.create') }}">Thêm
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
                            <select name="staff_id" class="form-select">
                                <option value="">-- Tất cả nhân viên --</option>
                                @foreach( $staffs as $staff)
                                    <option
                                        value="{{ $staff->id }}" {{ request('staff_id') == $staff->id ? 'selected' : '' }}>
                                        {{ $staff->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <div id="result-table">
                        @include('page.transaction.transaction_table', ['transactions' => $transactions])
                    </div>
                </div>
            </div>
        </div>
    </main>
    @foreach($transactions as $transaction)
        <div class="modal fade" id="viewTransactionModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #9e1f1e;">
                        <h5 class="modal-title text-white">Chi tiết giao dịch</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body text-dark">
                        <div class="row mb-2">
                            <div class="col-md-12"><strong>Tên giao dịch:</strong> {{ $transaction->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Nhân viên thực hiện:</strong> {{ $transaction->staff->name ?? '---' }}</div>
                            <div class="col-md-6"><strong>Hợp đồng:</strong> {{ $transaction->contract->name ?? '---' }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6"><strong>Ngày giao dịch:</strong> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</div>
                            <div class="col-md-6"><strong>Số tiền:</strong> {{ number_format($transaction->amount) }} VNĐ</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <strong>Nội dung:</strong>
                                <div class="p-2 border rounded bg-light mt-1" style="white-space: pre-line;">
                                    {!! nl2br(e($transaction->content)) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <strong>File đính kèm:</strong>
                                @if ($transaction->file)
                                    <a href="{{ asset('storage/' . $transaction->file) }}" target="_blank" class="ms-2">Tải xuống</a>
                                @else
                                    Không có
                                @endif
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
                url: '{{ route("transaction.search") }}',
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

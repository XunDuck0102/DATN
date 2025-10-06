@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3">Chỉnh sửa giao dịch</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white" style="background-color: #9e1f1e;">
                            <h5 class="mb-0 text-white">Thông tin giao dịch</h5>
                        </div>
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Tên giao dịch <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên giao dịch"
                                           value="{{ old('name', $transaction->name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Người thực hiện <span class="text-danger">*</span></label>
                                    <select name="staff_id" class="form-select" required>
                                        <option value="">-- Chọn nhân viên --</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{ $staff->id }}" {{ $staff->id == $transaction->staff_id ? 'selected' : '' }}>
                                                {{ $staff->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Hợp đồng liên quan <span class="text-danger">*</span></label>
                                    <select name="contract_id" class="form-select" required>
                                        <option value="">-- Chọn hợp đồng --</option>
                                        @foreach($contracts as $contract)
                                            <option value="{{ $contract->id }}" {{ $contract->id == $transaction->contract_id ? 'selected' : '' }}>
                                                {{ $contract->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ngày giao dịch <span class="text-danger">*</span></label>
                                    <input type="date" name="transaction_date" class="form-control"
                                           value="{{ old('transaction_date', $transaction->transaction_date) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                                    <textarea name="content" class="form-control" rows="4" placeholder="Nhập nội dung giao dịch" required>{{ old('content', $transaction->content) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số tiền (VNĐ) <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" class="form-control" min="0"
                                           value="{{ old('amount', $transaction->amount) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tệp đính kèm</label>
                                    <input type="file" name="file" class="form-control">
                                    @if(!empty($transaction->file))
                                        <div class="mt-2">
                                            <a href="{{ $transaction->file }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                Xem file hiện tại
                                            </a>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success px-4">Cập nhật</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

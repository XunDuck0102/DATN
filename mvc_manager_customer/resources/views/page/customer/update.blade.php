@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3">Chỉnh sửa khách hàng</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white" style="background-color: #9e1f1e;">
                            <h5 class="mb-0 text-white">Thông tin khách hàng</h5>
                        </div>
                        <form action="{{ route('customer.put', $customer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số CMND/CCCD</label>
                                    <input type="text" name="identity_number" class="form-control" value="{{ old('identity_number', $customer->identity_number) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày cấp</label>
                                    <input type="date" name="identity_issued_date" class="form-control" value="{{ old('identity_issued_date', $customer->identity_issued_date) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nơi cấp</label>
                                    <input type="text" name="identity_issued_place" class="form-control" value="{{ old('identity_issued_place', $customer->identity_issued_place) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mã số thuế</label>
                                    <input type="text" name="tax_code" class="form-control" value="{{ old('tax_code', $customer->tax_code) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', $customer->address) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày bắt đầu nhượng quyền</label>
                                    <input type="date" name="franchise_start_date" class="form-control" value="{{ old('franchise_start_date', $customer->franchise_start_date) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="status" class="form-select">
                                        <option value="active" {{ old('status', $customer->status) === 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                                        <option value="suspended" {{ old('status', $customer->status) === 'suspended' ? 'selected' : '' }}>Tạm ngưng</option>
                                        <option value="closed" {{ old('status', $customer->status) === 'closed' ? 'selected' : '' }}>Đã đóng</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ảnh cửa hàng</label>
                                    <input type="file" name="store_photo" class="form-control">
                                    @if ($customer->store_photo)
                                        <div class="mt-2">
                                            <img src="{{ $customer->store_photo }}" alt="Ảnh cửa hàng" class="img-thumbnail" style="max-height: 150px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số tài khoản ngân hàng</label>
                                    <input type="text" name="bank_account" class="form-control" value="{{ old('bank_account', $customer->bank_account) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tên ngân hàng</label>
                                    <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name', $customer->bank_name) }}">
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

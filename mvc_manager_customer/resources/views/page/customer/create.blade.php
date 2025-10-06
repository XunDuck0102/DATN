@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3">Tạo mới khách hàng</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white" style="background-color: #9e1f1e;">
                            <h5 class="mb-0 text-white">Thông tin khách hàng</h5>
                        </div>
                        <form action="{{ route('customer.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập họ và tên" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số CMND/CCCD</label>
                                    <input type="text" name="identity_number" class="form-control" placeholder="VD: 123456789">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày cấp</label>
                                    <input type="date" name="identity_issued_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nơi cấp</label>
                                    <input type="text" name="identity_issued_place" class="form-control" placeholder="VD: CA Hà Nội">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mã số thuế</label>
                                    <input type="text" name="tax_code" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày bắt đầu nhượng quyền</label>
                                    <input type="date" name="franchise_start_date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="status" class="form-select">
                                        <option value="active">Đang hoạt động</option>
                                        <option value="suspended">Tạm ngưng</option>
                                        <option value="closed">Đã đóng</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ảnh cửa hàng</label>
                                    <input type="file" name="store_photo" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số tài khoản ngân hàng</label>
                                    <input type="text" name="bank_account" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tên ngân hàng</label>
                                    <input type="text" name="bank_name" class="form-control">
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success px-4">Lưu</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

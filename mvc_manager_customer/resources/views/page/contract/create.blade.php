@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3">Tạo mới hợp đồng</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white" style="background-color: #9e1f1e;">
                            <h5 class="mb-0 text-white">Thông tin hợp đồng</h5>
                        </div>
                        <form action="{{ route('contract.post') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Tên hợp đồng <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên hợp đồng" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Khách hàng <span class="text-danger">*</span></label>
                                    <select name="customer_id" class="form-select" required>
                                        <option value="">-- Chọn khách hàng --</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nhân viên phụ trách <span class="text-danger">*</span></label>
                                    <select name="staff_id" class="form-select" required>
                                        <option value="">-- Chọn nhân viên --</option>
                                        @foreach($staffs as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nội dung hợp đồng</label>
                                    <textarea name="content" rows="4" class="form-control" placeholder="Nhập nội dung chi tiết hợp đồng..."></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Trạng thái hợp đồng</label>
                                    <select name="status" class="form-select">
                                        @foreach(\App\Models\Contract::STATUSES as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ngày ký</label>
                                    <input type="date" name="signed_date" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ngày kết thúc</label>
                                    <input type="date" name="end_date" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tệp đính kèm</label>
                                    <input type="file" name="file" class="form-control">
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

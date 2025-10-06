@php use App\Models\Customer;use App\Models\User; @endphp
@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row d-flex">
                <div class="col-11">
                    <h1 class="h3"> Danh sách khách hàng</h1>
                </div>
                <div class="col-1">
                    <a class="btn btn-primary" style="margin-bottom: 5px" href="{{ route('customer.create') }}">Thêm
                        mới</a>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <form id="search-form" class="row g-3 mb-4">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên, email...">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">-- Tất cả trạng thái --</option>
                                @foreach(Customer::STATUSES as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <div id="result-table">
                        @include('page.customer.customer_table', ['customers' => $customers])
                    </div>
                </div>

            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="customerDetailModal" tabindex="-1" aria-labelledby="customerDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #9e1f1e;">
                    <h5 class="modal-title text-white" id="customerDetailModalLabel">Chi tiết khách hàng</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>

                <div class="modal-body text-dark">
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Mã KH:</strong> <span id="modal-code"></span></div>
                        <div class="col-md-6"><strong>Họ tên:</strong> <span id="modal-name"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>CMND/CCCD:</strong> <span id="modal-identity-number"></span></div>
                        <div class="col-md-6"><strong>Ngày cấp:</strong> <span id="modal-identity-issued-date"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Nơi cấp:</strong> <span id="modal-identity-issued-place"></span></div>
                        <div class="col-md-6"><strong>Mã số thuế:</strong> <span id="modal-tax-code"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>SĐT:</strong> <span id="modal-phone"></span></div>
                        <div class="col-md-6"><strong>Email:</strong> <span id="modal-email"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12"><strong>Địa chỉ:</strong> <span id="modal-address"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Ngày nhượng quyền:</strong> <span id="modal-franchise-start-date"></span></div>
                        <div class="col-md-6"><strong>Trạng thái:</strong> <span id="modal-status"></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><strong>Số tài khoản:</strong> <span id="modal-bank-account"></span></div>
                        <div class="col-md-6"><strong>Ngân hàng:</strong> <span id="modal-bank-name"></span></div>
                    </div>
                    <div class="row mb-2 d-none" id="store-photo-wrap">
                        <div class="col-12">
                            <strong>Ảnh cửa hàng:</strong><br>
                            <img id="modal-store-photo" src="" class="img-thumbnail mt-2" style="max-height: 250px;">
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.btn-show-customer', function () {
            const btn = $(this);
            $('#modal-code').text(btn.data('code'));
            $('#modal-name').text(btn.data('name'));
            $('#modal-identity-number').text(btn.data('identity_number'));
            $('#modal-identity-issued-date').text(btn.data('identity_issued_date'));
            $('#modal-identity-issued-place').text(btn.data('identity_issued_place'));
            $('#modal-tax-code').text(btn.data('tax_code'));
            $('#modal-phone').text(btn.data('phone'));
            $('#modal-email').text(btn.data('email'));
            $('#modal-address').text(btn.data('address'));
            $('#modal-franchise-start-date').text(btn.data('franchise_start_date'));
            $('#modal-status').text(btn.data('status'));
            $('#modal-bank-account').text(btn.data('bank_account'));
            $('#modal-bank-name').text(btn.data('bank_name'));

            const photo = btn.data('store_photo');
            if (photo) {
                $('#modal-store-photo').attr('src', '/storage/' + photo);
                $('#store-photo-wrap').removeClass('d-none');
            } else {
                $('#store-photo-wrap').addClass('d-none');
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            function performSearch() {
                $.ajax({
                    url: "{{ route('customer.search') }}",
                    type: "GET",
                    data: $('#search-form').serialize(),
                    success: function (response) {
                        $('#result-table').html(response);
                    },
                    error: function () {
                        alert('Có lỗi xảy ra!');
                    }
                });
            }

            $('#search-form input[name="keyword"]').on('input', function () {
                performSearch();
            });

            $('#search-form select[name="status"]').on('change', function () {
                performSearch();
            });
        });
    </script>
@endsection

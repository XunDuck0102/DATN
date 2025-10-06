@php use App\Models\User; @endphp
@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row d-flex">
                <div class="col-11">
                    <h1 class="h3"> Danh sách tài khoản</h1>
                </div>
                <div class="col-1">
                    <a class="btn btn-primary" style="margin-bottom: 5px" href="{{ route('account.create') }}">Thêm
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
                            <select name="role" class="form-select">
                                <option value="">-- Tất cả quyền --</option>
                                @foreach(User::ROLES as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <div id="result-table">
                        @include('page.account.account_table', ['users' => $users])
                    </div>
                </div>

            </div>

        </div>
    </main>
    <script>
        $(document).ready(function () {
            function performSearch() {
                $.ajax({
                    url: "{{ route('account.search') }}",
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

            $('#search-form select[name="role"]').on('change', function () {
                performSearch();
            });
        });
    </script>
@endsection

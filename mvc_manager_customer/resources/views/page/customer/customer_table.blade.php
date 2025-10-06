@php use App\Models\Customer; @endphp
<table class="table table-hover my-0">
    <thead>
    <tr>
        <th>STT</th>
        <th>Mã KH</th>
        <th>Tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Trạng thái</th>
        <th>Ngày bắt đầu nhượng quyền</th>
        <th>Địa chỉ</th>
        <th class="text-center">Hành động</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $key => $val)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $val->code ?? '' }}</td>
            <td>{{ $val->name ?? ''  }}</td>
            <td>{{ $val->email ?? ''  }}</td>
            <td>{{ $val->phone ?? ''  }}</td>
            <td>{{ Customer::STATUSES[$val->status] ?? '' }}</td>
            <td class="text-center">{{ $val->franchise_start_date ?? ''  }}</td>
            <td>{{ $val->address ?? ''  }}</td>
            <td class="text-center">
                <button
                    class="btn btn-info btn-sm text-white btn-show-customer"
                    data-bs-toggle="modal"
                    data-bs-target="#customerDetailModal"
                    data-id="{{ $val->id }}"
                    data-code="{{ $val->code }}"
                    data-name="{{ $val->name }}"
                    data-identity_number="{{ $val->identity_number }}"
                    data-identity_issued_date="{{ $val->identity_issued_date }}"
                    data-identity_issued_place="{{ $val->identity_issued_place }}"
                    data-tax_code="{{ $val->tax_code }}"
                    data-phone="{{ $val->phone }}"
                    data-email="{{ $val->email }}"
                    data-address="{{ $val->address }}"
                    data-franchise_start_date="{{ $val->franchise_start_date }}"
                    data-status="{{ Customer::STATUSES[$val->status] ?? '' }}"
                    data-bank_account="{{ $val->bank_account }}"
                    data-bank_name="{{ $val->bank_name }}"
                    data-store_photo="{{ $val->store_photo }}"
                >
                    Xem
                </button>
                <a href="{{ route('customer.update', $val->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                <button class="btn btn-sm btn-danger"
                        onclick="confirmDelete('{{ route('customer.delete', $val->id) }}')">
                    Xóa
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    function confirmDelete(url) {
        if (confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')) {
            window.location.href = url;
        }
    }
</script>

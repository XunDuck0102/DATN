@php use App\Models\Contract;use Carbon\Carbon; @endphp
<table class="table table-hover my-0">
    <thead>
    <tr>
        <th>STT</th>
        <th>Mã hợp đồng</th>
        <th>Tên hợp đồng</th>
        <th>Khách hàng</th>
        <th>Nhân viên phụ trách</th>
        <th>Ngày ký</th>
        <th>Trạng thái</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
    @forelse($contracts as $key => $contract)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $contract->code }}</td>
            <td>{{ $contract->name }}</td>
            <td>{{ $contract->customer->name ?? '---' }}</td>
            <td>{{ $contract->staff->name ?? '---' }}</td>
            <td>{{ Carbon::parse($contract->signed_date)->format('d/m/Y') }}</td>
            <td>{{ Contract::STATUSES[$contract->status] ?? '---' }}</td>
            <td class="text-center">
                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                        data-bs-target="#viewContractModal{{ $contract->id }}">Xem
                </button>
                <a href="{{ route('contract.update', $contract->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                <button class="btn btn-sm btn-danger"
                        onclick="confirmDelete('{{ route('contract.delete', $contract->id) }}')">
                    Xóa
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">Không có dữ liệu</td>
        </tr>
    @endforelse
    </tbody>
</table>
<script>
    function confirmDelete(url) {
        if (confirm('Bạn có chắc chắn muốn xóa hợp đồng này không?')) {
            window.location.href = url;
        }
    }
</script>

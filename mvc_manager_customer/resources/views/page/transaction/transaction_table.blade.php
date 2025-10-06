@php use App\Models\Transaction;use Carbon\Carbon; @endphp
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên giao dịch</th>
        <th>Nhân viên</th>
        <th>Hợp đồng</th>
        <th>Ngày giao dịch</th>
        <th>Số tiền</th>
        <th class="text-center">Hành động</th>
    </tr>
    </thead>
    <tbody>
    @forelse($transactions as $key => $transaction)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $transaction->name }}</td>
            <td>{{ $transaction->staff->name ?? '' }}</td>
            <td>{{ $transaction->contract->name ?? '' }}</td>
            <td>{{ Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td>
            <td>{{ number_format($transaction->amount) }} VNĐ</td>
            <td class="text-center">
                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                        data-bs-target="#viewTransactionModal{{ $transaction->id }}">Xem
                </button>
                <a href="{{ route('transaction.update', $transaction->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                <button class="btn btn-sm btn-danger"
                        onclick="confirmDelete('{{ route('transaction.delete', $transaction->id) }}')">
                    Xóa
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">Không có giao dịch nào phù hợp.</td>
        </tr>
    @endforelse
    </tbody>
</table>
<script>
    function confirmDelete(url) {
        if (confirm('Bạn có chắc chắn muốn xóa giao dịch này không?')) {
            window.location.href = url;
        }
    }
</script>

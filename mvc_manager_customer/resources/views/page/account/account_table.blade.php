@php use App\Models\User; @endphp
<table class="table table-hover my-0">
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Ngày sinh</th>
        <th>Quyền</th>
        <th>Địa chỉ</th>
        <th class="text-center">Hành động</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $val)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $val->name }}</td>
            <td>{{ $val->email }}</td>
            <td>{{ $val->phone }}</td>
            <td>{{ $val->dob }}</td>
            <td>{{ User::ROLES[$val->role] ?? '' }}</td>
            <td>{{ $val->address }}</td>
            <td class="text-center">
                <a href="{{ route('account.update', $val->id) }}" class="btn btn-sm btn-primary">Sửa</a>
                <button class="btn btn-sm btn-danger"
                        onclick="confirmDelete('{{ route('account.delete', $val->id) }}')">
                    Xóa
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    function confirmDelete(url) {
        if (confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')) {
            window.location.href = url;
        }
    }
</script>

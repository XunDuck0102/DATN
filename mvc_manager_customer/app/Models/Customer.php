<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'code',
        'name',
        'identity_number',
        'identity_issued_date',
        'identity_issued_place',
        'tax_code',
        'phone',
        'email',
        'address',
        'franchise_start_date',
        'status',
        'store_photo',
        'bank_account',
        'bank_name',
    ];
    public const STATUS_ACTIVE = 'active';
    public const STATUS_SUSPENDED = 'suspended';
    public const STATUS_CLOSED = 'closed';

    public const STATUSES = [
        self::STATUS_ACTIVE => 'Hoạt động',
        self::STATUS_SUSPENDED => 'Tạm ngưng',
        self::STATUS_CLOSED => 'Đã đóng',
    ];
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}

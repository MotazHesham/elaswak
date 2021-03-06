<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use Auditable;

    public const PAYMENT_STATUS_SELECT = [
        'unpaid' => 'لم يتم الدفع',
        'paid'   => 'تم الدفع',
    ];

    public const PAYMENT_TYPE_SELECT = [
        'cash_on_delivery' => 'الدفع عند الأستلام',
        'credit_card'      => 'الدفع أونلاين',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'     => 'قيد الأنتطار',
        'on_review'   => 'قيد المراجعة',
        'on_delivery' => 'مع المندوب',
        'delivered'   => 'تم التوصيل',
        'canceled'    => 'تم الألغاء',
    ];

    public $table = 'orders';

    public static $searchable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'discount_code',
        'discount',
        'total_cost',
        'district_id',
        'city_id',
        'zip_code',
        'address',
        'payment_type',
        'payment_status',
        'delivery_status',
        'cancel_reason',
        'delegate_id',
        'done_status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function offers()
    {
        return $this->hasMany(OrderOffer::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

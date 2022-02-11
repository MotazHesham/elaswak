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
        'unpaid' => 'Un Paid',
        'paid'   => 'Paid',
    ];

    public const PAYMENT_TYPE_SELECT = [
        'cash_on_delivery' => 'Cash On Delivery',
        'credit_card'      => 'Credit Card',
    ];

    public const DELIVERY_STATUS_SELECT = [
        'pending'     => 'Pending',
        'on_review'   => 'On Review',
        'on_delivery' => 'On Delivery',
        'delivered'   => 'Delivered',
        'canceled'    => 'Canceled',
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
        'district_id',
        'city_id',
        'zip_code',
        'address',
        'payment_type',
        'payment_status',
        'delivery_status',
        'cancel_reason',
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
        return $this->belongsToMany(Product::class);
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'suppliers';

    protected $dates = [
        'commerical_expiry',
        'licence_expiry',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company_name',
        'commerical_num',
        'commerical_expiry',
        'licence_num',
        'licence_expiry',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function supplierProducts()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }

    public function supplierOffers()
    {
        return $this->hasMany(Offer::class, 'supplier_id', 'id');
    }

    public function getCommericalExpiryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCommericalExpiryAttribute($value)
    {
        $this->attributes['commerical_expiry'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getLicenceExpiryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setLicenceExpiryAttribute($value)
    {
        $this->attributes['licence_expiry'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

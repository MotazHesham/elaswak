<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegate extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'delegates';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'discount_code',
        'discount',
        'facebook',
        'instagram',
        'youtube',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function delegateMoneyRequests()
    {
        return $this->hasMany(MoneyRequest::class, 'delegate_id', 'id');
    }

    public function delegateTargets()
    {
        return $this->belongsToMany(Target::class)->withpivot(['orders','achieved','achieved_date','profit']);
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

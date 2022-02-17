<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyRequest extends Model
{
    use SoftDeletes;

    public const STATUS_SELECT = [
        'pending' => 'قيد الانتظار',
        'done'    => 'تم التحويل بنجاح',
        'refused' => 'تم الرفض',
    ];

    public $table = 'money_requests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'amount',
        'delegate_id',
        'description',
        'status',
        'target_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function delegate()
    {
        return $this->belongsTo(Delegate::class, 'delegate_id');
    }

    public function target()
    {
        return $this->belongsTo(Target::class, 'target_id');
    }
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
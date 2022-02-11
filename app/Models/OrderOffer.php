<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderOffer extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'order_offer';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_id',
        'offer_id',
        'quantity',
        'total_cost', 
        'created_at',
        'updated_at',
        'deleted_at',
    ]; 
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

}

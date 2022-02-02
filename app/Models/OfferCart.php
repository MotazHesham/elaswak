<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class OfferCart extends Model
{
    public $table = 'offer_carts';

    protected $dates = [
        'created_at',
        'updated_at', 
    ];

    protected $fillable = [
        'offer_id',
        'user_id',
        'quantity',
        'total_cost',
        'created_at',
        'updated_at', 
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
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

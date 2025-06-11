<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
   'seat_number',
    'price',
    'from',
    'to',
    'date',
    'travel_date',
    'travel_time',
    'user_id',
    'status',
];
    protected $casts = [
        'is_sold' => 'boolean',
    ];

    // Relationships
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
  public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function isAdmin() {
    return $this->role === 'admin';
    }
    public function isBuyer() {
        return $this->role === 'buyer';
    }


    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_sold', false);
    }

    public function scopeSold($query)
    {
        return $query->where('is_sold', true);
    }
}

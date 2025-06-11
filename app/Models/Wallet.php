<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function credit(int $amount)
    {
        $this->balance += $amount;
        $this->save();
    }

    public function debit(int $amount)
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient balance');
        }
        $this->balance -= $amount;
        $this->save();
    }
}

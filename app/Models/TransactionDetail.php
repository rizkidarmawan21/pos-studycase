<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'product' => 'array'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}

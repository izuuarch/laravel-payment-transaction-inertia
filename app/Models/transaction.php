<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'transactionsable_id',
        'transactionsable_type',
        'payment_name',
        'userid',
        'payment_status',
        'transaction_id',
        'payment_amount',
    ];
    protected $guarded = [];
    public function transactionsable(){
   return $this->morphTo();
    }
}

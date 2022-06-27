<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    protected $dates = ['created_at','updated_at'];

    protected $fillable = [
        'id',
        'account_id',
        'ammount',
        'event',
    ];

}

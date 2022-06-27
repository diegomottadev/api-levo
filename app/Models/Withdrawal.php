<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $table = 'withdrawals';

    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'id',
        'account_id',
        'try' => 0,
        'reason'
    ];
    
    public function account(){
        return $this->belongsTo(Account::class);
    }


}

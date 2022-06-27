<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model

{
    protected $table = 'accounts';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'id',
        'number_account',
        'balance',
        'email'
    ];


    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function transation()
    {
        return $this->hasOne(Transaction::class)->latest();
    }

    public function getThreeTryWithdrawal(){
        $currentDateTime = (Carbon::now())->format('Y-m-d');
        $newDateTime = (Carbon::now()->subHours(48))->format('Y-m-d');
        return $this->withdrawals->where('reason','saldo negativo')->whereBetween('created_at',[$newDateTime." 00:00:00",$currentDateTime." 23:59:59"])->count()>=3;
    }
}

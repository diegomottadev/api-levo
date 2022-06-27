<?php

namespace App\Http\Controllers;

use App\Events\AccountTryWithdrawal;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaccionController extends ApiController
{
    //
    public function store(Request $request, Account $account){

        //Si es deposito o retiro
        $motivo =  $request->reason == 'retiro';
        $amount = $request->ammout;
        if ($motivo && $amount > 0){

            $resultBalance = $account->balance - $amount;
            $conditionBalance = $resultBalance > 0 &&  $amount < 10000;
            //devuelve la utima transacción
            $lastTransaction = $account->transation()->first();
            //si son aptas las condiciones se ejecuta el retiro normalmente
            if ($conditionBalance){

                $dt = Carbon::now();
                if($lastTransaction!=null){
                  $lateDate =  $lastTransaction->created_at;
                  $diff = ($dt)->diffInRealHours($lateDate);
                  $resultBalanceTransationsLast = $lastTransaction->ammount + $amount;

                  if($diff <= 24 && $resultBalanceTransationsLast > 10000){
                      $withdrawal = new Withdrawal();
                      $withdrawal->try =  1;
                      $withdrawal->reason = 'intento de retiro mayor a 10000 en menos de 24 hs';
                      $withdrawal->account_id = $account->id;
                      $withdrawal->save();
                      return $this->showOne($withdrawal);
                  }
                }

                $transation =new Transaction();
                $transation->account_id = $account->id;
                $transation->ammount = $amount;
                $transation->event ='retiro';
                $transation->save();
                $account->balance = $account->balance - $amount;
                $account->save();
                return $this->showOne($transation);

            }
            //si el balance es negativo se registra el intento de retiro y el motivo
            if($resultBalance < 0){
                $withdrawal = new Withdrawal();
                $withdrawal->try = 1;
                $withdrawal->reason = 'saldo negativo';
                $withdrawal->account_id = $account->id;

                $withdrawal->save();
                if($account->getThreeTryWithdrawal()){
                    AccountTryWithdrawal::dispatch($account);
                }

                return $this->showOne($withdrawal);
            }
            //si el balance es negativo se registra el intento de retiro y el motivo
            if($amount > 10000){
                $withdrawal = new Withdrawal();
                $withdrawal->try =  1;
                $withdrawal->reason = 'intento de retiro mayor a 10000';
                $withdrawal->account_id = $account->id;
                $withdrawal->save();
                return $this->showOne($withdrawal);
            }
        }
    }
}

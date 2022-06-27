<?php

namespace Tests\Feature;

use App\Events\AccountTryWithdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TryWithdrawarsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_try_withdrawal_three_times()
    {
        \App\Models\Account::create([
            "number_account" => "000001",
            "balance" => 1000,
            "email" => "cuenta01@banco.com"
        ]);

        \App\Models\Account::create([
            "number_account" => "000002",
            "balance" => 1000,
            "email" => "cuenta01@banco.com"
        ]);

        \App\Models\Account::create([
            "number_account" => "000003",
            "balance" => 1000,
            "email" => "cuenta01@banco.com"
        ]);

        \App\Models\Account::create([
            "number_account" => "000004",
            "balance" => 1000,
            "email" => "cuenta01@banco.com"
        ]);

        Event::fake();

        $response = $this->post('api/transactions/4',['reason' => 'retiro','ammout' => '2300']);
        $response = $this->post('api/transactions/4',['reason' => 'retiro','ammout' => '2300']);
        $response = $this->post('api/transactions/4',['reason' => 'retiro','ammout' => '2300']);
        $response = $this->post('api/transactions/4',['reason' => 'retiro','ammout' => '2300']);
        $response = $this->post('api/transactions/4',['reason' => 'retiro','ammout' => '2300']);

        // El evento para enviar una alerta porque hizo mas de tres retiros y con saldo negativo a la cuenta fue despachado
        Event::assertDispatched(AccountTryWithdrawal::class);
    }
}

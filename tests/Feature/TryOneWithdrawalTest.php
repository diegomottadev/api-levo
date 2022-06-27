<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TryOneWithdrawalTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_try_withdrawal_ok()
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
        $response = $this->post('api/transactions/2',['reason' => 'retiro','ammout' => '2300']);
        $response
            ->assertStatus(200)
            ->assertJson([
                'reason' => 'saldo negativo',
            ]);
    }
}

<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\TestTime\TestTime;
use Tests\TestCase;

class TryMoreTimeWithdrawaInADayTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_try_withdrawal_in_less_24hs()
    {
        \App\Models\Account::create([
            "number_account" => "000001",
            "balance" => 11000,
            "email" => "cuenta01@banco.com"
        ]);

        $response = $this->post('api/transactions/1',['reason' => 'retiro','ammout' => '4300']);
        //TestTime para simular tiempos entre las transacciones
        TestTime::freeze();
        TestTime::addHours(15);

        $response = $this->post('api/transactions/1',['reason' => 'retiro','ammout' => '6000']);

        $response
            ->assertStatus(200)
            ->assertJson([
                'reason' => 'intento de retiro mayor a 10000 en menos de 24 hs',
            ]);
    }
}

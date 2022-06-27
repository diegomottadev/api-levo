<?php

namespace Tests\Feature;

use App\Events\AccountTryWithdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class TryTwoWithDrawalInADayTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_try_two_with_drawal_in_a_day()
    {
        \App\Models\Account::create([
            "number_account" => "000001",
            "balance" => 1000,
            "email" => "cuenta01@banco.com"
        ]);

        Event::fake();

        $response = $this->post('api/transactions/1',['reason' => 'retiro','ammout' => '2300']);
        $response = $this->post('api/transactions/1',['reason' => 'retiro','ammout' => '2300']);
//        $response = $this->post('api/transactions/1',['reason' => 'retiro','ammout' => '2300']);
//        $response = $this->post('api/transactions/1',['reason' => 'retiro','ammout' => '2300']);

        // Ningun evento fue despachado por saldo negativo
        //Event::assertNothingDispatched();

        Event::assertNotDispatched(AccountTryWithdrawal::class);

    }
}

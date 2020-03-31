<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\library\CreditCard;

class CreditCardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidNumber()
    {
        $this->assertTrue(CreditCard::Set('4444333322221111'));
    }

    function testInvalidNumberShouldReturError() {
		$this->assertEquals( 'ERROR_INVALID_LENGTH', CreditCard::Set('3333555522221111') );
	}

	function testValidNumberShouldSetAndGet() {
		CreditCard::Set('4444333322221111');
		$this->assertEquals('4444333322221111',CreditCard::Get());
	}
}

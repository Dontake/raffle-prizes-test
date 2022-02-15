<?php

namespace Tests\Unit;

use App\Repositories\LoyaltyBonus\LoyaltyBonusRepository;
use App\Services\Loyalty\BonusService;
use Exception;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class CashToBonusConvert extends TestCase
{
    use DatabaseTransactions;

    protected BonusService $bonusService;
    protected LoyaltyBonusRepository $bonusRepository;

    private static int $expectedResult = 55;

    public function setUp(): void
    {
        parent::setUp();

        $this->bonusService = new BonusService(new LoyaltyBonusRepository());
        $this->bonusRepository = new LoyaltyBonusRepository();
    }

    /**
     * Check conversion cash into bonuses
     * Base case
     *
     * @group cash-to-bonus-convert
     * @test cash-to-bonus-convert-base
     * @return void
     * @throws Exception
     */
    public function cashToBonusConvertBase()
    {
        $cashInt = 548;
        $defaultCurrency = 'USD';

        $result = $this->bonusService->cashToBonusConvert($cashInt, $defaultCurrency);

        $this->assertIsInt($result);
        $this->assertEquals(self::$expectedResult, $result);
    }

    /**
     * Check conversion cash into bonuses
     * From float cash
     *
     * @group cash-to-bonus-convert
     * @test cash-to-bonus-convert-float
     * @return void
     * @throws Exception
     */
    public function cashToBonusConvertFloat()
    {
        $cashFloat = 548.5;
        $defaultCurrency = 'USD';

        $result = $this->bonusService->cashToBonusConvert($cashFloat, $defaultCurrency);

        $this->assertIsInt($result);
        $this->assertEquals(self::$expectedResult, $result);
    }

    /**
     * Check conversion cash into bonuses
     * From unknown currency
     *
     * @group cash-to-bonus-convert
     * @test cash-to-bonus-convert-from-unknown-currency
     * @return void
     * @throws Exception
     */
    public function cashToBonusConvertFromUnknownCurrency()
    {
        $cashFloat = 548.5;
        $defaultCurrency = 'RUB';

        $result = $this->bonusService->cashToBonusConvert($cashFloat, $defaultCurrency);

        $this->assertIsFloat($result);
        $this->assertEquals($cashFloat, $result);
    }
}

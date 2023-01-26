<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Entities\Prize\PrizeEntity;
use App\Entities\Prize\Type\PrizeMoneyTypeEntity;
use App\Repositories\Prize\PrizeRepository;
use App\Services\Prize\PrizeService;
use App\Services\Prize\Type\MoneyPrizeService;
use App\Services\Prize\Type\PrizeTypeService;
use Mockery\MockInterface;
use Tests\TestCase;

class PrizeServiceTest extends TestCase
{

    private PrizeService $prizeService;

    public function setUp(): void
    {
        parent::setUp();

        $playable = (new PrizeMoneyTypeEntity())->setId(rand(1, 100))->setCount(rand(1, 100));

        $prizeRepo = $this->mock(PrizeRepository::class, function (MockInterface $mock) use ($playable) : void {
            $mock->shouldReceive('save')->andReturn((new PrizeEntity(
                rand(1, 100), rand(1, 100), \Str::random(), \Str::random(), rand(1, 100)
            )));
            $mock->shouldReceive('getPlayable')->andReturn($playable);
            $mock->shouldReceive('delete')->andReturn(true);
        });

        $moneyService = $this->mock(MoneyPrizeService::class, function (MockInterface $mock) use ($playable) : void {
            $mock->shouldReceive('play')->andReturn($playable);
            $mock->shouldReceive('refuse')->andReturn(true);
        });

        $prizeTypeService = $this->mock(PrizeTypeService::class, function (MockInterface $mock) use ($moneyService) : void {
            $mock->shouldReceive('setType')->andReturn((new PrizeTypeService())->setType($moneyService));
        });

        $this->prizeService = new PrizeService($prizeRepo, $prizeTypeService);
    }

    public function testPlay(): void
    {
        $userId = rand(1, 100);

        $result = $this->prizeService->play($userId);

        $this->assertInstanceOf(PrizeEntity::class, $result);
    }

    public function testRefuse(): void
    {
        $prizeId = rand(1, 100);
        $count = rand(1, 100);

        $result = $this->prizeService->refuse($prizeId, $count);

        $this->assertTrue($result);
    }

}

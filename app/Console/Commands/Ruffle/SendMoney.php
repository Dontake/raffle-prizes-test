<?php

namespace App\Console\Commands\Ruffle;

use App\Extensions\BankApi\ClientBankApi;
use App\Repositories\Prize\PrizeRepository;
use App\Services\Raffle\RafflePrizeService;
use Illuminate\Console\Command;

class SendMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:money';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send money on users cache accounts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $raffleService = (new RafflePrizeService(new PrizeRepository()));

        foreach ($raffleService->getRaffledMoney() as $prize) {
            (new ClientBankApi())->send('remittance', [
                'account' => $prize->user->cacheAccount?->getAccount(),
                'amount' => $prize->getCount(),
            ]);
        }
    }
}

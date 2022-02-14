<?php

namespace App\Console\Commands\Ruffle;

use App\Extensions\BankApi\ClientBankApi;
use App\Models\Prize\Prize;
use App\Repositories\Prize\PrizeRepository;
use Illuminate\Console\Command;

class SendMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:money-pack {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send money on users cash accounts by count';

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
        $prize = new PrizeRepository();

        /** @var Prize $money */
        foreach ($prize->getRaffledMoney($this->argument('count')) as $money) {
            $account = $money->user?->cashAccount?->getAccount();

            if (!$account) {
                continue;
            }

             /** TODO: REAL HTTP CLIENT */
            $response = (new ClientBankApi())->send('remittance', [
                'account' => $account,
                'amount' => $money->getCount(),
            ]);

            if ($response->successful()) {
                $money->setStatus(Prize::STATUS_SENT);
            }
        }
    }
}

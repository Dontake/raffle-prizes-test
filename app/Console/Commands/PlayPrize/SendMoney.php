<?php

namespace App\Console\Commands\PlayPrize;

use App\Entities\Prize\PrizeEntity;
use App\Enums\Prize\PrizeStatusEnum;
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
    public function handle(): void
    {
        $prize = new PrizeRepository();

        /** @var Prize $money */
        foreach ($prize->getPlayedMoney($this->argument('count')) as $money) {
            $checked = $prize->checkNotSent($money->id);
            $account = $money->user?->cashAccount?->account;

            if (!$account || !$checked) {
                continue;
            }

             /** TODO: REAL HTTP CLIENT */
            $response = (new ClientBankApi())->send('remittance', [
                'account' => $account,
                'amount' => $money->count,
            ]);

            if ($response->successful()) {
                $money->status = PrizeStatusEnum::SENT;
                $prize->save(new PrizeEntity(
                    $money->id,
                    $money->user_id,
                    $money->type,
                    $money->status,
                    $money->count)
                );
            }
        }
    }
}

<?php

use App\Enums\Wallet\WalletCurrencyEnum;
use App\Enums\LoyaltyBonus\LoyaltyBonusMonetaryEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('loyalty_bonuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('balance');
            $table->decimal('monetary_equivalent')->default(LoyaltyBonusMonetaryEnum::USD_EQUIVALENT);
            $table->string('currency', 3)->default(WalletCurrencyEnum::USD);

            $table->boolean('is_active')->default(true);

            $table->index(['user_id', 'balance', 'currency']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_bonuses');
    }
};

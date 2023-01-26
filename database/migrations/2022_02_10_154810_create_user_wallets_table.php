<?php

use App\Enums\Wallet\WalletCurrencyEnum;
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
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('account');
            $table->decimal('balance')->default(0);
            $table->string('currency', 3)->default(WalletCurrencyEnum::USD);

            $table->boolean('is_active')->default(true);

            $table->index(['user_id', 'account']);

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
        Schema::dropIfExists('user_wallets');
    }
};

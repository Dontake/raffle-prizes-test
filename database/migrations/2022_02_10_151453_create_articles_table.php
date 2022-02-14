<?php

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
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 500);
            $table->text('description');
            $table->integer('count')->default(0);

            $table->tinyInteger('is_active')->default(true);

            $table->index(['name', 'count']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('prizes', function (Blueprint $table) {
            $table->foreignId('article_id')->nullable()
                ->after('user_id')
                ->constrained()
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prizes', function (Blueprint $table) {
            $table->dropForeign('prizes_article_id_foreign');
        });

        Schema::dropIfExists('articles');
    }
};

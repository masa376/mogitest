<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     *
     */
    public function up(): void
    {
        Schema::create('product_season', function (Blueprint $table) {
        $table->id();

        // 親テーブルの「id」を参照（デフォルトで id を参照します）
        $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
        $table->foreignId('season_id')->constrained('seasons')->restrictOnDelete();

        // 同じ組み合わせの重複を防ぐ
        $table->unique(['product_id', 'season_id']);

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     */
    public function down():void
    {
        Schema::dropIfExists('product_season');
    }
};

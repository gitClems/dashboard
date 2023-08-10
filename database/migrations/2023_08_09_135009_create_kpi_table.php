<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kpi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('NB_NEW_INSCRITS');
            $table->integer('NB_NEW_CLIENTS');
            $table->integer('NB_EXPEDITIONS');
            $table->integer('NB_ACHATS');
            $table->integer('NB_NEW_INSCRITS');
            $table->decimal('CHIFFRE_AFFAIRE', 20,6)->default(0.00);
            $table->integer('NB_ACHATS_PACK');
            $table->integer('NB_ACHATS_ONESHOT');
            $table->integer('NB_ACHATS_PACK');
            $table->decimal('MONTANT_ACHATS_PACK', 20,6)->default(0.00);
            $table->decimal('MONTANT_ACHATS_ONESHOT', 20,6)->default(0.00);
            $table->integer('NB_EXPEDITIONS_C2C');
            $table->integer('POURCENT_C2C');
            $table->integer('TOTAL_CREDIT_ACHETE');
            $table->integer('CONSIGNES_EN_PRODUCTION');
            $table->integer('CONSIGNES_NEW');
            $table->integer('NB_CASHBACK');
            $table->decimal('VOLUME_CASHBACK', 20,6)->default(0.00);
            $table->integer('NB_AIO_EXPEDITIONS');
            $table->date('DATE_REPORT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi');
    }
};

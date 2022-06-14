<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KpiMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_master', function (Blueprint $table) {
            $table->id();

            $table->string('fungsi')->nullable();
            $table->string('percent_master')->nullable();
            $table->longText('link')->nullable();

            $table->string('objektif')->nullable();
            $table->string('pencapaian')->nullable();
            $table->string('skor_KPI')->nullable();
            $table->string('skor_sebenar')->nullable();
            
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_master');
    }
}

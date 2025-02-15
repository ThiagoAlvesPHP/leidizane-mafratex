<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ops', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->onDelete('cascade');
            $table->string('number_op');
            $table->date('date_op');
            $table->time('preiod_start_init');
            $table->time('period_start_end');
            $table->time('period_stop_init')->nullable();
            $table->time('period_stop_end')->nullable();
            $table->decimal('quantity');
            $table->decimal('quantity_primary');
            $table->decimal('quantity_secondy');
            $table->decimal('quantity_third')->nullable();
            $table->decimal('quantity_longitudinal')->nullable();
            $table->decimal('quantity_transversal')->nullable();
            $table->decimal('quantity_court')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ops');
    }
};

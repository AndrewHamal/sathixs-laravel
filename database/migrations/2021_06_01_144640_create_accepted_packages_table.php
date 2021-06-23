<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptedPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accepted_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id')
                ->constrained('riders')
                ->cascadeOnDelete();
            $table->foreignId('package_id')
                ->constrained('packages')
                ->cascadeOnDelete();
            $table->foreignId('cancel_reasons_id')
                ->nullable()
                ->constrained('cancel_reasons')
                ->cascadeOnDelete();
            $table->text('custom_cancel_reason')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('accepted_packages');
    }
}

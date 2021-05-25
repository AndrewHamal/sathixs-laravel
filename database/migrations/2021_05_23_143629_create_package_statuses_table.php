<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('process_step')->comment('1 is receive, 2 is on the way, 3 delivered');
            $table->integer('rider_id');
            $table->foreignId('package_id')
                ->constrained('packages')
                ->cascadeOnDelete();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('package_statuses');
    }
}

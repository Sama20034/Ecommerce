<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->decimal('cost_price', 10, 2)->default(0); // Adjust type as needed
        });
    }

    public function down()
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->dropColumn('cost_price');
        });
    }
};

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
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('package_type')->nullable()->change();
            $table->string('sender_phone')->nullable()->change();
            $table->string('sender_email')->nullable()->change();
            $table->string('receiver_phone')->nullable()->change();
            $table->string('receiver_email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('package_type')->nullable(false)->change();
            $table->string('sender_phone')->nullable(false)->change();
            $table->string('sender_email')->nullable(false)->change();
            $table->string('receiver_phone')->nullable(false)->change();
            $table->string('receiver_email')->nullable(false)->change();
        });
    }
};

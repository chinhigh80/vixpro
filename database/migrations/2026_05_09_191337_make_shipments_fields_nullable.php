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
            $table->text('content_description')->nullable()->change();
            $table->json('dimensions')->nullable()->change();
            $table->date('estimated_delivery_date')->nullable()->change();
            $table->date('actual_delivery_date')->nullable()->change();
            $table->timestamp('delivered_at')->nullable()->change();
            $table->foreignId('created_by')->nullable()->change();
            $table->foreignId('assigned_driver_id')->nullable()->change();
            $table->foreignId('branch_id')->nullable()->change();
            $table->string('proof_of_delivery')->nullable()->change();
            $table->string('label_pdf_path')->nullable()->change();
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
            $table->text('content_description')->nullable(false)->change();
            $table->json('dimensions')->nullable(false)->change();
            $table->date('estimated_delivery_date')->nullable(false)->change();
            $table->date('actual_delivery_date')->nullable(false)->change();
            $table->timestamp('delivered_at')->nullable(false)->change();
            $table->foreignId('created_by')->nullable(false)->change();
            $table->foreignId('assigned_driver_id')->nullable(false)->change();
            $table->foreignId('branch_id')->nullable(false)->change();
            $table->string('proof_of_delivery')->nullable(false)->change();
            $table->string('label_pdf_path')->nullable(false)->change();
        });
    }
};

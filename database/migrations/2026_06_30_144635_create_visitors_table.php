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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('state');
            $table->string('district')->nullable();
            $table->string('other_state_name')->nullable();
            $table->string('business_name');
            $table->string('business_category');
            $table->string('business_activity');
            $table->boolean('has_website');
            $table->string('website_url')->nullable();
            $table->boolean('interested_in_webpage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};

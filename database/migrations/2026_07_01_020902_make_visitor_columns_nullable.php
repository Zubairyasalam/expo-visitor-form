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
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('mobile_number')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->string('business_name')->nullable()->change();
            $table->string('business_category')->nullable()->change();
            $table->string('business_activity')->nullable()->change();
            $table->boolean('has_website')->nullable()->change();
            $table->boolean('interested_in_webpage')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->string('name')->change();
            $table->string('mobile_number')->change();
            $table->string('state')->change();
            $table->string('business_name')->change();
            $table->string('business_category')->change();
            $table->string('business_activity')->change();
            $table->boolean('has_website')->change();
            $table->boolean('interested_in_webpage')->change();
        });
    }
};

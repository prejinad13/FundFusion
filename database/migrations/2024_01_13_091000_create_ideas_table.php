<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investee_id');
            $table->string('name');
            $table->string('slug');
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('video_link')->nullable();
            $table->string('required_investment_amount')->nullable();
            $table->string('estimated_return')->nullable();
            $table->string('return_on_investment')->nullable();
            $table->string('team_size')->nullable();
            $table->boolean('has_multiple_investor')->default(0);
            $table->enum('status',['open','closed'])->default('open');
            $table->timestamps();
            $table->foreign('investee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};

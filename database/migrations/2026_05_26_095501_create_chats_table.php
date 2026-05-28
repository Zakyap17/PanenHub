<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained('users')->onDelete('cascade');
            $table->string('product_name');
            $table->string('farmer_name');
            $table->integer('offer_qty'); // dalam kg
            $table->integer('offer_price'); // per kg
            $table->bigInteger('offer_total');
            $table->bigInteger('offer_dp');
            $table->text('notes')->nullable();
            $table->string('status')->default('open'); // open, closed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};

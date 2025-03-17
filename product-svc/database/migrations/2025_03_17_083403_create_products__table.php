<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->uuid('unique_id')->default(DB::raw('(gen_random_uuid())'));
                $table->unsignedBigInteger('user_id')->nullable(false);
                $table->string('name', 64);
                $table->enum('origin', ['local', 'import']);
                $table->integer('stock');
                $table->text('description');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_');
    }
};

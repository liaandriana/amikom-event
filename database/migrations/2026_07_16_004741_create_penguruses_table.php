<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {

            $table->id();

            $table->foreignId('jabatan_id')
                ->constrained('jabatans')
                ->cascadeOnDelete();

            $table->string('name');

            $table->text('description')->nullable();

            $table->decimal('salary',12,2);

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};
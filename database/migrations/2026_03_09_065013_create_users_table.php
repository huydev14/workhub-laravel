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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedTinyInteger('sex')->default(0)->comment('O: nam, 1: nữ');

            $table->foreignId('part_id')->nullable()->constrained('parts')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('positions')->cascadeOnUpdate()->nullOnDelete();

            $table->unsignedTinyInteger('type_work')->default(0)->comment('O: full-time, 1: part-time');

            $table->foreignId('team_id')->nullable()->constrained('teams')->cascadeOnUpdate()->nullOnDelete();

            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('O: đang làm, 1: nghỉ việc');
            $table->dateTime('start_day')->nullable();
            $table->dateTime('end_day')->nullable();

            $table->foreignId('type_account_id')->nullable()->constrained('type_accounts')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

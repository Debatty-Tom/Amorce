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
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign('draw_id')->references('id')->on('draws');
            $table->foreign('donator_id')->references('id')->on('donators');
        });

        Schema::table('assignments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('todo_id')->references('id')->on('todos');
        });

        Schema::table('draw_assignments', function (Blueprint $table) {
            $table->foreign('draw_id')->references('id')->on('draws');
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

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
        Schema::table('user_exam_que_ans', function (Blueprint $table) {
            $table->bigInteger('user_exam_id')->unsigned()->after('id');

            $table->foreign('user_exam_id')->references('id')->on('user_exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_exam_que_ans', function (Blueprint $table) {
            $table->dropForeign('user_exam_id');
            $table->dropColumn('user_exam_id');
        });
    }
};

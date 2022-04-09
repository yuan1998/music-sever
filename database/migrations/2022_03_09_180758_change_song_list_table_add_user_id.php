<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSongListTableAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song_list', function (Blueprint $table) {
            $table->unsignedBigInteger('create_by')->nullable();
            $table->dateTime('create_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('song_list', function (Blueprint $table) {
            $table->dropColumn('create_by');
            $table->dropColumn('create_date');
        });
    }
}

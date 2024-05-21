<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocfeedFeed extends Migration
{
    public function up()
    {
        Schema::table('feeds', function (Blueprint $table) {
            // Add the new column
            $table->string('doc_feed')->nullable()->after('deskripsi');
        });
    }

    public function down()
    {
        Schema::table('feeds', function (Blueprint $table) {
            // Drop the new column
            $table->dropColumn('doc_feed');
        });
    }
}

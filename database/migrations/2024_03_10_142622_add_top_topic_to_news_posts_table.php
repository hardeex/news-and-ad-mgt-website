<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('news_posts', function (Blueprint $table) {
        $table->boolean('top_topic')->default(false);
    });
}

public function down()
{
    Schema::table('news_posts', function (Blueprint $table) {
        $table->dropColumn('top_topic');
    });
}


 
};

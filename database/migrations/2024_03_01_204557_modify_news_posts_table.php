<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNewsPostsTable extends Migration
{
    public function up()
    {
        Schema::table('news_posts', function (Blueprint $table) {
            $table->longText('content')->change();
        });
    }

    public function down()
    {
        Schema::table('news_posts', function (Blueprint $table) {
            $table->string('content')->change();
        });
    }
}


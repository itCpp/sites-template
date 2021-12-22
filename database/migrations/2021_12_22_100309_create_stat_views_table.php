<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class CreateStatViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_views', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip')->comment('IP клиента')->nullable();
            $table->string('page', 500)->comment('Страница просмотра')->nullable();
            $table->string('referer', 500)->comment('Адрес прихода на страницу')->nullable();
            $table->json('request_data')->comment('Объект данных')->default(new Expression('(JSON_ARRAY())'));
            $table->string('user_agent', 500)->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stat_views');
    }
}

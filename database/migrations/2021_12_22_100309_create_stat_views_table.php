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
            $table->ipAddress('ip')->nullable()->comment('IP клиента')->index();
            $table->string('method', 30)->nullable()->comment('Метод обращения');
            $table->string('page', 500)->nullable()->comment('Страница просмотра');
            $table->string('referer', 500)->nullable()->comment('Адрес прихода на страницу');
            $table->json('request_data')->default(new Expression('(JSON_ARRAY())'))->comment('Объект данных');
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

<?php
namespace UnixDevel\Feeds\Updates;

use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

/**
 * @class CreateCrawlersTable
 */
class CreateCrawlersTable extends Migration
{
    public function up():void
    {
        Schema::create('unixdevel_crawlers', static function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('status')->default('finish');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('unixdevel_crawlers');
    }

}

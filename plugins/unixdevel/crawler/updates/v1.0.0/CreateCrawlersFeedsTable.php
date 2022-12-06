<?php
namespace UnixDevel\Feeds\Updates;

use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

/**
 * @class CreateCrawlersFeedsTable
 */
class CreateCrawlersFeedsTable extends Migration
{
    public function up():void
    {
        Schema::create('unixdevel_crawlers_feeds', static function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('feed_id')->unsigned();
            $table->integer('crawler_id')->unsigned();
            $table->primary(['feed_id', 'crawler_id']);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('unixdevel_crawlers_feeds');
    }

}

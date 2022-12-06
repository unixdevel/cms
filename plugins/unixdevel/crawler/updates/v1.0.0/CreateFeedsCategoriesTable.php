<?php
namespace UnixDevel\Feeds\Updates;

use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

/**
 */
class CreateFeedsCategoriesTable extends Migration
{
    public function up()
    {

        Schema::create('unixdevel_feeds_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('feed_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['feed_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('unixdevel_feeds_categories');
    }

}

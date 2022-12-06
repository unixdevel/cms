<?php

namespace UnixDevel\Crawler\Contracts;

use UnixDevel\Crawler\Models\Crawler;

interface CrawlerContract
{
    public function process(Crawler $crawler):void;
}

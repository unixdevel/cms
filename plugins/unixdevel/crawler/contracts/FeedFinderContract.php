<?php

namespace UnixDevel\Crawler\Contracts;

use UnixDevel\Crawler\DTO\FeedDTO;

interface FeedFinderContract
{
    public function find(string $topic, string $language):FeedDTO;
}

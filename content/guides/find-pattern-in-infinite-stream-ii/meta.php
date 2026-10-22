<?php
declare(strict_types=1);

return [
    'title' => 'Find Pattern in Infinite Stream II: streaming KMP with larger limits',
    'leetcode' => 3037,
    'difficulty' => 'Hard',
    'summary' => 'Part I’s method already runs in linear time: build the KMP failure table of the pattern and feed stream bits one by one until a full match, then return the index of its first bit.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['array', 'interactive', 'string-matching', 'sliding-window', 'hash-function', 'rolling-hash', 'leetcode'],
    'related_session' => 'find-pattern-in-infinite-stream-ii',
];

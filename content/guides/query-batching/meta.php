<?php
declare(strict_types=1);

return [
    'title' => 'Query Batching: queue the callers, send their keys together',
    'leetcode' => 2756,
    'difficulty' => 'Hard',
    'summary' => 'Keep a queue of (key, resolve, reject). When the throttle lets a call go, take the whole queue, send its keys at once, and route the i-th value to the i-th caller.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'query-batching',
];

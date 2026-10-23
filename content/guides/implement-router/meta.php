<?php
declare(strict_types=1);

return [
    'title' => 'Implement Router: a FIFO queue, a duplicate set, and timestamp lists',
    'leetcode' => 3508,
    'difficulty' => 'Med',
    'summary' => 'Packets leave in arrival order, and timestamps arrive sorted, so each destination’s timestamps form a sorted list whose removed packets are always a prefix. Track that prefix with a start index and answer counts with two binary searches.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'queue', 'array', 'hash-table', 'binary-search', 'leetcode'],
    'related_session' => 'implement-router',
];

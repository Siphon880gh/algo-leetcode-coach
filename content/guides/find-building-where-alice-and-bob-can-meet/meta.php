<?php
declare(strict_types=1);

return [
    'title' => 'Find Building Where Alice and Bob Can Meet: offline monotonic stack',
    'leetcode' => 2940,
    'difficulty' => 'Hard',
    'summary' => 'Order a < b. If a = b or heights[a] < heights[b], the answer is b. Otherwise find the leftmost j > b with heights[j] > heights[a]; answer those offline from the right with a monotonic stack and binary search.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'stack', 'monotonic-stack', 'binary-indexed-tree', 'segment-tree', 'heap', 'leetcode'],
    'related_session' => 'find-building-where-alice-and-bob-can-meet',
];

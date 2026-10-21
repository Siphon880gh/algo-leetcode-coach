<?php
declare(strict_types=1);

return [
    'title' => 'Design Most Recently Used Queue: Fenwick tree over slots',
    'leetcode' => 1756,
    'difficulty' => 'Med',
    'summary' => 'Give every element a slot; new ends go to fresh slots after the current last. A Fenwick tree counts live slots, so the k-th live slot is found by binary lifting. Fetch removes that slot and appends its value to a new one.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'binary-indexed-tree', 'queue', 'leetcode'],
    'related_session' => 'design-most-recently-used-queue',
];

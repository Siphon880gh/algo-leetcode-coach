<?php
declare(strict_types=1);

return [
    'title' => 'Peaks in Array: Fenwick tree of peak flags',
    'leetcode' => 3187,
    'difficulty' => 'Hard',
    'summary' => 'Store a 0/1 peak flag per index in a Fenwick tree. A count on [l, r] sums flags on l + 1 … r − 1; an update rechecks only i − 1, i and i + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['binary-indexed-tree', 'segment-tree', 'array', 'leetcode'],
    'related_session' => 'peaks-in-array',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of K-Divisible Components: cut every divisible subtree',
    'leetcode' => 2872,
    'difficulty' => 'Hard',
    'summary' => 'Process nodes bottom-up. Whenever a subtree’s sum is divisible by k, cut it off as a component; otherwise pass its sum to the parent.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'leetcode'],
    'related_session' => 'maximum-number-of-k-divisible-components',
];

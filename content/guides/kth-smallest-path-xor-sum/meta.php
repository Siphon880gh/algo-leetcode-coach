<?php
declare(strict_types=1);

return [
    'title' => 'Kth Smallest Path XOR Sum: small-to-large sorted sets',
    'leetcode' => 3590,
    'difficulty' => 'Hard',
    'summary' => 'Compute each node’s root XOR. Process nodes bottom-up, merging children’s sets of distinct XORs into the largest one (small to large), and answer each query at its node from the merged set with an order-statistic structure.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'ordered-set', 'leetcode'],
    'related_session' => 'kth-smallest-path-xor-sum',
];

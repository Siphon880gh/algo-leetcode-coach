<?php
declare(strict_types=1);

return [
    'title' => 'Find the Maximum Sum of Node Values: any even set can flip',
    'leetcode' => 3068,
    'difficulty' => 'Hard',
    'summary' => 'Applying the operation along a path flips only its two ends, so any even-sized set of nodes can be XORed with k. Take max(x, x XOR k) everywhere; if an odd number of nodes improved, give back the smallest |gain|.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'tree', 'array', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'find-the-maximum-sum-of-node-values',
];

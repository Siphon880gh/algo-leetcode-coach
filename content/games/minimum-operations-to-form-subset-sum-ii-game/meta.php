<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Form Subset Sum II',
    'leetcode' => 4041,
    'difficulty' => 'Hard',
    'summary' => 'Now doublings and halvings can mix in any order, so halving first and then doubling reaches new values (6 halves to 3, which can double past 6). BFS from each element over values up to about 2 times sum to get the fewest operations per reachable value, then run the same 0-1 knapsack.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-form-subset-sum-ii',
    'related_session' => 'minimum-operations-to-form-subset-sum-ii',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Distribute Repeating Integers: subset DP over customers',
    'leetcode' => 1655,
    'difficulty' => 'Hard',
    'summary' => 'Only the counts of distinct values matter (≤ 50). With m ≤ 10 customers, f(i, mask) asks whether values i… can satisfy the customers in mask; value i serves any submask whose total quantity fits its count.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'backtracking', 'leetcode'],
    'related_session' => 'distribute-repeating-integers',
];

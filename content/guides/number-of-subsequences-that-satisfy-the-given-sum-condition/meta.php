<?php
declare(strict_types=1);

return [
    'title' => 'Number of Subsequences That Satisfy the Given Sum Condition: sort + two pointers',
    'leetcode' => 1498,
    'difficulty' => 'Med',
    'summary' => 'Only min + max matters, so sort. For each left index l with nums[l] + nums[r] ≤ target, every subset of (l, r] together with l is valid: 2^(r − l) subsequences.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'sorting', 'math', 'leetcode'],
    'related_session' => 'number-of-subsequences-that-satisfy-the-given-sum-condition',
];

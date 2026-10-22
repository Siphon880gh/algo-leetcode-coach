<?php
declare(strict_types=1);

return [
    'title' => 'Count Special Subsequences: equal reduced ratios',
    'leetcode' => 3404,
    'difficulty' => 'Med',
    'summary' => 'nums[p] · nums[r] = nums[q] · nums[s] means nums[p] / nums[q] = nums[s] / nums[r]. Sweep r; when it moves, add pairs (p, q = r − 2) to a counter of reduced fractions, then count s ≥ r + 2 whose nums[s] / nums[r] is in the counter.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'enumeration', 'leetcode'],
    'related_session' => 'count-special-subsequences',
];

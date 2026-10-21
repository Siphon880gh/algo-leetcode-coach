<?php
declare(strict_types=1);

return [
    'title' => 'Continuous Subarray Sum: prefix mod k with the first index seen',
    'leetcode' => 523,
    'difficulty' => 'Med',
    'summary' => 'Is there a subarray of length ≥ 2 whose sum is a multiple of k? Two prefix sums with the same remainder mod k bound such a subarray. Store the first index of each remainder, seeded with {0: −1}; return true if a remainder repeats at least 2 indexes later. [23,2,4,6,7], 6 → true. [23,2,6,4,7], 13 → false.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'hash-table', 'math', 'leetcode'],
    'related_session' => 'continuous-subarray-sum',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With More Ones Than Zeros: prefix balance counts',
    'leetcode' => 2031,
    'difficulty' => 'Med',
    'summary' => 'Map 1 → +1 and 0 → −1; a subarray qualifies when its end prefix sum exceeds its start prefix sum. Prefix sums move by ±1, so keep counts per prefix value and a running count of earlier prefixes strictly below the current one, updated in O(1) per step.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'hash-table', 'counting', 'leetcode'],
    'related_session' => 'count-subarrays-with-more-ones-than-zeros',
];

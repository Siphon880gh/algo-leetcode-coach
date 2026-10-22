<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Good Subarray Sum: prefix sums by value',
    'leetcode' => 3026,
    'difficulty' => 'Med',
    'summary' => 'A good subarray ends at j and starts at an i with nums[i] = nums[j] ± k. Its sum is pre[j + 1] − pre[i], so keep, for each value, the smallest prefix sum before an index holding it.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-good-subarray-sum',
];

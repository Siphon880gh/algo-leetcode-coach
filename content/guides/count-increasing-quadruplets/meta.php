<?php
declare(strict_types=1);

return [
    'title' => 'Count Increasing Quadruplets: grow the 1-3-2 count, then close with a larger l',
    'leetcode' => 2552,
    'difficulty' => 'Hard',
    'summary' => 'Count i < j < k < l with nums[i] < nums[k] < nums[j] < nums[l]. Scan l; for each earlier j with nums[j] > nums[l], cnt[j] collects pairs (i, k) found so far, and when nums[j] < nums[l], cnt[j] quadruplets close.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'enumeration', 'leetcode'],
    'related_session' => 'count-increasing-quadruplets',
];

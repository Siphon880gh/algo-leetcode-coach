<?php
declare(strict_types=1);

return [
    'title' => 'Subarray Sum Equals K: count earlier prefix sums equal to s − k',
    'leetcode' => 560,
    'difficulty' => 'Med',
    'summary' => 'Count subarrays whose sum is k. A subarray (i, j] sums to k when prefix[j] − prefix[i] = k. Walk with a running sum s and a counter of prefixes seen (seed {0: 1}); add cnt[s − k] before recording s. Negatives rule out a sliding window. [1,1,1], 2 → 2. [1,2,3], 3 → 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'hash-table', 'leetcode'],
    'related_session' => 'subarray-sum-equals-k',
];

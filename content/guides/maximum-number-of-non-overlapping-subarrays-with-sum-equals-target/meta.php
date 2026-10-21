<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Non-Overlapping Subarrays With Sum Equals Target: greedy reset',
    'leetcode' => 1546,
    'difficulty' => 'Med',
    'summary' => 'Scan with prefix sums in a set. As soon as some earlier prefix equals current − target, count a subarray and reset the set (so the next one starts after it). Ending early is always optimal.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'prefix-sum', 'hash-table', 'leetcode'],
    'related_session' => 'maximum-number-of-non-overlapping-subarrays-with-sum-equals-target',
];

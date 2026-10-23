<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Non-Overlapping Subarrays With Sum Equals Target',
    'leetcode' => 1546,
    'difficulty' => 'Med',
    'summary' => 'Greedy: keep a set of prefix sums since the last cut. As soon as prefix − target is in it, take that subarray, count it, and reset the set to {0} with prefix 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-non-overlapping-subarrays-with-sum-equals-target',
    'related_session' => 'maximum-number-of-non-overlapping-subarrays-with-sum-equals-target',
];

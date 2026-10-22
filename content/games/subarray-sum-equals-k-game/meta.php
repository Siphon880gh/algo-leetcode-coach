<?php
declare(strict_types=1);

return [
    'title' => 'Subarray Sum Equals K: look up prefix − k',
    'leetcode' => 560,
    'difficulty' => 'Med',
    'summary' => 'Keep a running prefix sum and a map count[prefix] (count[0] = 1 at the start). At each index, every earlier prefix equal to prefix − k starts a subarray that sums to k: add count[prefix − k], then record this prefix.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'subarray-sum-equals-k',
    'related_session' => 'subarray-sum-equals-k',
];

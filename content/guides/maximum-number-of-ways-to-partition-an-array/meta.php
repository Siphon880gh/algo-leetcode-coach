<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Ways to Partition an Array: count differences on both sides',
    'leetcode' => 2025,
    'difficulty' => 'Hard',
    'summary' => 'For pivot p let diff = prefix − suffix. Changing nums[i] by d = k − nums[i] adds d to diff for pivots after i and subtracts it for pivots up to i. Keep counters of diffs left and right of i and take the best of diff = −d on the right plus diff = d on the left, or no change.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'hash-table', 'counting', 'leetcode'],
    'related_session' => 'maximum-number-of-ways-to-partition-an-array',
];

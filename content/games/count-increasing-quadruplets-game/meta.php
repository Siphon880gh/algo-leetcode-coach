<?php
declare(strict_types=1);

return [
    'title' => 'Count Increasing Quadruplets: fix the middle pair (j, k)',
    'leetcode' => 2552,
    'difficulty' => 'Hard',
    'summary' => 'For i < j < k < l we need nums[i] < nums[k] < nums[j] < nums[l]. For each j < k with nums[k] < nums[j]: (count of i < j with nums[i] < nums[k]) times (count of l > k with nums[l] > nums[j]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-increasing-quadruplets',
    'related_session' => 'count-increasing-quadruplets',
];

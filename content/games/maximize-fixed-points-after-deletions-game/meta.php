<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Fixed Points After Deletions',
    'leetcode' => 3920,
    'difficulty' => 'Hard',
    'summary' => 'nums[i] can become a fixed point only if nums[i] ≤ i, after deleting d = i − nums[i] earlier elements. Two kept fixed points need increasing values and non-decreasing d. Sort candidates by (d, value) and find the longest strictly increasing run of values with patience sorting.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-fixed-points-after-deletions',
    'related_session' => 'maximize-fixed-points-after-deletions',
];

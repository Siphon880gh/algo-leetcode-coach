<?php
declare(strict_types=1);

return [
    'title' => 'Longest Non-Decreasing Subarray After Replacing at Most One Element',
    'leetcode' => 3738,
    'difficulty' => 'Med',
    'summary' => 'left[i] = non-decreasing run ending at i, right[i] = run starting at i. Replacing nums[i] joins left[i−1] and right[i+1] if nums[i−1] at most nums[i+1]; otherwise it only extends one side by 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-non-decreasing-subarray-after-replacing-at-most-one-element',
    'related_session' => 'longest-non-decreasing-subarray-after-replacing-at-most-one-element',
];

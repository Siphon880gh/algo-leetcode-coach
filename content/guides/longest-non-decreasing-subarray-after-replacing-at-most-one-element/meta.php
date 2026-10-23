<?php
declare(strict_types=1);

return [
    'title' => 'Longest Non-Decreasing Subarray After Replacing at Most One Element: runs on both sides',
    'leetcode' => 3738,
    'difficulty' => 'Med',
    'summary' => 'L[i] is the non-decreasing run ending at i and R[i] the one starting at i. A replacement extends one run by 1, or joins L[i − 1] and R[i + 1] through i when nums[i − 1] ≤ nums[i + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'longest-non-decreasing-subarray-after-replacing-at-most-one-element',
];

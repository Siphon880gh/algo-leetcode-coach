<?php
declare(strict_types=1);

return [
    'title' => 'Longest Alternating Subarray After Removing At Most One Element: prefix and suffix runs',
    'leetcode' => 3830,
    'difficulty' => 'Hard',
    'summary' => 'Compute the longest alternating run ending at each index (by last comparison up or down) and starting at each index. Removing i joins the run ending at i − 1 with the one starting at i + 1 when nums[i − 1] and nums[i + 1] compare the right way.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'enumeration', 'leetcode'],
    'related_session' => 'longest-alternating-subarray-after-removing-at-most-one-element',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Max and Min Sums of Size ≤ k Subsequences: count roles per element',
    'leetcode' => 3428,
    'difficulty' => 'Med',
    'summary' => 'Sort. nums[i] is the maximum of Σ_{j<k} C(i, j) subsequences (pick up to k − 1 smaller ones before it) and the minimum of Σ_{j<k} C(n−1−i, j). Add value × (both counts).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-and-minimum-sums-of-at-most-size-k-subsequences',
    'related_session' => 'maximum-and-minimum-sums-of-at-most-size-k-subsequences',
];

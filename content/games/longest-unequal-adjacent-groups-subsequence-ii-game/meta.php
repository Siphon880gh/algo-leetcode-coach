<?php
declare(strict_types=1);

return [
    'title' => 'Longest Unequal Adjacent Groups II: LIS with Hamming distance 1',
    'leetcode' => 2901,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = longest valid chain ending at word i, extending j < i when groups differ, lengths match and the Hamming distance is exactly 1. Rebuild from the best end with parent links.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-unequal-adjacent-groups-subsequence-ii',
    'related_session' => 'longest-unequal-adjacent-groups-subsequence-ii',
];

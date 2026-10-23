<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Cost of Trip With K Highways',
    'leetcode' => 2247,
    'difficulty' => 'Hard',
    'summary' => 'Bitmask DP: dp[mask][v] = max cost of a path visiting exactly mask and ending at v. Extend by unvisited neighbors; answer = max over masks with k + 1 cities.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-cost-of-trip-with-k-highways',
    'related_session' => 'maximum-cost-of-trip-with-k-highways',
];

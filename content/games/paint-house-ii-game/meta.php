<?php
declare(strict_types=1);

return [
    'title' => 'Paint House II: reuse the two smallest of the previous row',
    'leetcode' => 265,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][c] = costs[i][c] + the smallest previous total with a different color. Keep the best and second best of the last row so each cell is O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'paint-house-ii',
    'related_session' => 'paint-house-ii',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Path Score in a Grid',
    'leetcode' => 3742,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j][c] = best score reaching (i, j) with total cost c, coming from the top or left. A 1 costs 1 and scores 1, a 2 costs 1 and scores 2. The answer is the max over c at most k at the end, or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-path-score-in-a-grid',
    'related_session' => 'maximum-path-score-in-a-grid',
];

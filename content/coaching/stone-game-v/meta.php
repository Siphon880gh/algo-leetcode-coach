<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game V: interval DP keeping the lighter side',
    'leetcode' => 1563,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][j] = max over splits of the smaller side\'s sum + dp on that side; on equal sums Alice may keep either. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'stone-game-v',
    'tags' => ['dp', 'interval-dp', 'game-theory', 'step-by-step'],
];

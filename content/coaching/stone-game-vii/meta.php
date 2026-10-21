<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game VII: difference DP',
    'leetcode' => 1690,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i][j] = max(sum(i + 1 … j) − dp[i + 1][j], sum(i … j − 1) − dp[i][j − 1]) with prefix sums. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'stone-game-vii',
    'tags' => ['dynamic-programming', 'game-theory', 'prefix-sum', 'step-by-step'],
];

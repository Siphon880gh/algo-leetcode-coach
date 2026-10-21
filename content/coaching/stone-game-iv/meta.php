<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game IV: winning positions DP',
    'leetcode' => 1510,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[0] = false; dp[i] = true if some square j² ≤ i leaves dp[i − j²] false. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'stone-game-iv',
    'tags' => ['dp', 'game-theory', 'math', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'New 21 Game: probability DP with a sliding sum',
    'leetcode' => 837,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i] is the chance of ever holding i points, the average of the dp values in the window of maxPts scores below i that still draw. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'new-21-game',
    'tags' => ['dynamic-programming', 'probability', 'sliding-window', 'step-by-step'],
];

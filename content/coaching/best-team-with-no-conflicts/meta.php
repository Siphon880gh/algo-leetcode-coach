<?php
declare(strict_types=1);

return [
    'title' => 'Best Team With No Conflicts: sort and DP',
    'leetcode' => 1626,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort by (age, score); dp[i] = score[i] + max dp[j] with score[j] ≤ score[i]; answer max dp. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'best-team-with-no-conflicts',
    'tags' => ['dynamic-programming', 'sorting', 'step-by-step'],
];

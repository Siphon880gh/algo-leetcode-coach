<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Convert String III: DP over positions',
    'leetcode' => 3995,
    'difficulty' => 'Hard',
    'summary' => 'Each position is used by at most one rule, so rules always see the original characters. dp[i] = cheapest way to fix the first i positions: skip a position that already matches, or apply a rule whose pattern matches source and whose replacement equals target there.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-cost-to-convert-string-iii',
];

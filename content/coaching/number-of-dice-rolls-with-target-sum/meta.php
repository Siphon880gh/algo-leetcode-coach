<?php
declare(strict_types=1);

return [
    'title' => 'Number of Dice Rolls With Target Sum: one die per row',
    'leetcode' => 1155,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[s] counts ways to reach sum s, start with dp[0] = 1, and for each die build a new row from faces 1..k, mod 10⁹ + 7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-dice-rolls-with-target-sum',
    'tags' => ['dynamic-programming', 'step-by-step'],
];

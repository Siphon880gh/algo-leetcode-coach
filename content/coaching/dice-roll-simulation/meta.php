<?php
declare(strict_types=1);

return [
    'title' => 'Dice Roll Simulation: last face and run length',
    'leetcode' => 1223,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[j][k] counts sequences ending in face j repeated k times, switching faces resets k to 1 from every other face, and repeating extends k up to rollMax[j]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'dice-roll-simulation',
    'tags' => ['dynamic-programming', 'step-by-step'],
];

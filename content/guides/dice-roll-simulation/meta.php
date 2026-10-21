<?php
declare(strict_types=1);

return [
    'title' => 'Dice Roll Simulation: DP by last face and run length',
    'leetcode' => 1223,
    'difficulty' => 'Hard',
    'summary' => 'Let dp[j][k] count sequences ending in face j with exactly k copies of it at the end. A new different face starts a run of 1 from every other face\'s total; the same face extends k to k + 1 only while k + 1 ≤ rollMax[j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'dice-roll-simulation',
];

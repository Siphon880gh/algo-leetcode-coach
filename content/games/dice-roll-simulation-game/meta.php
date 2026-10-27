<?php
declare(strict_types=1);

return [
    'title' => 'Dice Roll Simulation: count by face and run length',
    'leetcode' => 1223,
    'difficulty' => 'Hard',
    'summary' => 'dp[f][r] = sequences ending in face f repeated exactly r times (r at most rollMax[f]). Rolling a different face starts r = 1 from the total; the same face extends r.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'dice-roll-simulation',
    'related_session' => 'dice-roll-simulation',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Paint House III: color and neighborhood count',
    'leetcode' => 1473,
    'difficulty' => 'Hard',
    'summary' => 'dp[c][t] = cheapest cost with the last house color c and t neighborhoods. Same color as before keeps t; a different color makes t + 1. Pre-painted houses cost 0 but force their color.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'paint-house-iii',
    'related_session' => 'paint-house-iii',
];

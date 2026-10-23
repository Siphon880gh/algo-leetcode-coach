<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game VIII: every move scores a prefix sum',
    'leetcode' => 1872,
    'difficulty' => 'Hard',
    'summary' => 'Each move scores some prefix sum P[i] (i ≥ 1). dp from the right: dp = P[n−1]; for i = n−2 down to 1: dp = max(dp, P[i] − dp).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stone-game-viii',
    'related_session' => 'stone-game-viii',
];

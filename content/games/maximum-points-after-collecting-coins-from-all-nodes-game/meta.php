<?php
declare(strict_types=1);

return [
    'title' => 'Collect Coins: subtract k or halve the subtree',
    'leetcode' => 2920,
    'difficulty' => 'Hard',
    'summary' => 'dp(u, j) where j = halvings applied by ancestors (coins become coins >> j). Option 1: (coins >> j) − k + Σ dp(c, j). Option 2: (coins >> (j+1)) + Σ dp(c, j+1). After ~14 halvings everything is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-points-after-collecting-coins-from-all-nodes',
    'related_session' => 'maximum-points-after-collecting-coins-from-all-nodes',
];

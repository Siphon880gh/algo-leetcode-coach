<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Damage: no damage within 2 of another',
    'leetcode' => 3186,
    'difficulty' => 'Med',
    'summary' => 'Group by damage value: total[v] = v · count. Sorted distinct values: dp[i] = max(dp[i−1], total[i] + dp[j]) where j is the last value < v − 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-total-damage-with-spell-casting',
    'related_session' => 'maximum-total-damage-with-spell-casting',
];

<?php
declare(strict_types=1);

return [
    'title' => 'House Robber: rob it or skip it',
    'leetcode' => 198,
    'difficulty' => 'Med',
    'summary' => 'At each house: rob it (best two houses back + this loot) or skip it (best through the previous house). dp[i] = max(dp[i−2] + nums[i], dp[i−1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'house-robber',
    'related_session' => 'house-robber',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game VI: best of the last k',
    'leetcode' => 1696,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = nums[i] + max dp[i−k to i−1]. A decreasing deque keeps that window maximum.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'jump-game-vi',
    'related_session' => 'jump-game-vi',
];

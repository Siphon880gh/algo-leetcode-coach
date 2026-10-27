<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Profit as the Salesman: offers ending at each house',
    'leetcode' => 2830,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = best gold using houses 0 to i−1. dp[i + 1] = max(dp[i], dp[start] + gold for every offer ending at house i).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-the-profit-as-the-salesman',
    'related_session' => 'maximize-the-profit-as-the-salesman',
];

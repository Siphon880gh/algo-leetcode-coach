<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Coins for Fruits: buying fruit i makes the next i free',
    'leetcode' => 2944,
    'difficulty' => 'Med',
    'summary' => 'From the right: dp[i] = prices[i] + min dp[j] for j in i+1 to 2i+1 (1-indexed), where anything past the end costs 0. Answer dp[1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-coins-for-fruits',
    'related_session' => 'minimum-number-of-coins-for-fruits',
];

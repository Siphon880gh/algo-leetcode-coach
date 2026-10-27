<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Jumps: longest chain of allowed jumps',
    'leetcode' => 2770,
    'difficulty' => 'Med',
    'summary' => 'dp[j] = most jumps to reach j = max over i < j with |nums[j] − nums[i]| at most target of dp[i] + 1 (unreachable stays −∞).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-jumps-to-reach-the-last-index',
    'related_session' => 'maximum-number-of-jumps-to-reach-the-last-index',
];

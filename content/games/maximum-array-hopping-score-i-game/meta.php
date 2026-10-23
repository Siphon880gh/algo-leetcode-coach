<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Array Hopping Score I: hop to j earns (j − i)·nums[j]',
    'leetcode' => 3205,
    'difficulty' => 'Med',
    'summary' => 'dp[j] = max over i < j of dp[i] + (j − i)·nums[j]. (Greedy: always hop to the largest value to the right.)',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-array-hopping-score-i',
    'related_session' => 'maximum-array-hopping-score-i',
];

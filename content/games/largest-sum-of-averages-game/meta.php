<?php
declare(strict_types=1);

return [
    'title' => 'Largest Sum of Averages: where does the last group start?',
    'leetcode' => 813,
    'difficulty' => 'Med',
    'summary' => 'dp[g][i] = best score for the first i numbers in g groups = max over j of dp[g−1][j] + average(nums[j to i)). With more groups allowed, splitting never hurts.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'largest-sum-of-averages',
    'related_session' => 'largest-sum-of-averages',
];

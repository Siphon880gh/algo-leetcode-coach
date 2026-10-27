<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sum After Divisible Sum Deletions',
    'leetcode' => 3654,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = smallest remaining sum of the first i elements. Either keep nums[i−1] (dp[i−1] + nums[i−1]) or delete a block ending here: any earlier prefix j with the same prefix sum mod k, so dp[i] = min(…, best[pre mod k]).',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-sum-after-divisible-sum-deletions',
    'related_session' => 'minimum-sum-after-divisible-sum-deletions',
];

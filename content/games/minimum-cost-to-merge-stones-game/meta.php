<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Merge Stones: interval DP in steps of k−1',
    'leetcode' => 1000,
    'difficulty' => 'Hard',
    'summary' => 'Possible only if (n − 1) % (k − 1) == 0. dp[i][j] = cheapest way to reduce stones[i..j] as far as possible: min over mid (stepping by k−1) of dp[i][mid] + dp[mid+1][j]; when (j − i) % (k − 1) == 0 it can become one pile: add sum(i..j).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-merge-stones',
    'related_session' => 'minimum-cost-to-merge-stones',
];

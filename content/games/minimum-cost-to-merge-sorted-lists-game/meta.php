<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Merge Sorted Lists',
    'leetcode' => 3801,
    'difficulty' => 'Hard',
    'summary' => 'The merged content of any subset of lists is fixed, so its length and median are too. Bitmask DP: dp[mask] = min over splitting mask into A and B of dp[A] + dp[B] + len(A) + len(B) + |med(A) − med(B)|.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-merge-sorted-lists',
    'related_session' => 'minimum-cost-to-merge-sorted-lists',
];

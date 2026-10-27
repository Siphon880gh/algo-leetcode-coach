<?php
declare(strict_types=1);

return [
    'title' => 'Constrained Subsequence Sum: best of the last k, via a deque',
    'leetcode' => 1425,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = nums[i] + max(0, max dp[i−k to i−1]). A decreasing deque of dp values gives the window max in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'constrained-subsequence-sum',
    'related_session' => 'constrained-subsequence-sum',
];

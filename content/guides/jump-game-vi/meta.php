<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game VI: DP with a monotonic deque',
    'leetcode' => 1696,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = nums[i] + max(dp[i − k … i − 1]). Keep indices in a deque with decreasing dp so the window maximum is at the front.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'monotonic-queue', 'heap', 'leetcode'],
    'related_session' => 'jump-game-vi',
];

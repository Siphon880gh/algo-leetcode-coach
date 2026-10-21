<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game VI: monotonic deque DP',
    'leetcode' => 1696,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i] = nums[i] + max of the last k dp values; keep a deque with decreasing dp so the max is at the front. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'jump-game-vi',
    'tags' => ['dynamic-programming', 'monotonic-queue', 'heap', 'step-by-step'],
];

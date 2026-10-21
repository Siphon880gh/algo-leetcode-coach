<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game II: suffix sums and best reply',
    'leetcode' => 1140,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: define dp(i, M) as the most the current player gets from piles i onward, take all if 2M reaches the end, otherwise maximise suffix[i] − dp(i + x, max(M, x)). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'stone-game-ii',
    'tags' => ['dynamic-programming', 'game-theory', 'prefix-sum', 'memoization', 'step-by-step'],
];

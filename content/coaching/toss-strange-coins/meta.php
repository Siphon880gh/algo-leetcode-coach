<?php
declare(strict_types=1);

return [
    'title' => 'Toss Strange Coins: heads-count DP',
    'leetcode' => 1230,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[k] is the chance of k heads so far, update k from target down to 1 with dp[k](1 − p) + dp[k − 1]p, then scale dp[0]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'toss-strange-coins',
    'tags' => ['dynamic-programming', 'probability', 'math', 'step-by-step'],
];

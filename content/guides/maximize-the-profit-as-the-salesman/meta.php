<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Profit as the Salesman: DP over houses',
    'leetcode' => 2830,
    'difficulty' => 'Med',
    'summary' => 'dp[i] is the best gold using houses before i. Each house can stay unsold, and each offer ending at e lets dp[e + 1] use dp[start] + gold.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'binary-search', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'maximize-the-profit-as-the-salesman',
];

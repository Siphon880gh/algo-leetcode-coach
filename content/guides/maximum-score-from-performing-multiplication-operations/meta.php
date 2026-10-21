<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score from Performing Multiplication Operations: DP on left count',
    'leetcode' => 1770,
    'difficulty' => 'Hard',
    'summary' => 'After i operations with l taken from the left, the right pointer is n − 1 − (i − l). dp[i][l] = max(take left, take right); only m² states matter.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'maximum-score-from-performing-multiplication-operations',
];

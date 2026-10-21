<?php
declare(strict_types=1);

return [
    'title' => 'Length of Longest Fibonacci Subsequence: DP on the last two elements',
    'leetcode' => 873,
    'difficulty' => 'Med',
    'summary' => 'A Fibonacci-like sequence is fixed by its last two numbers. dp[i][j] is the longest one ending in arr[i], arr[j]; the element before is arr[j] − arr[i], found with a value-to-index map.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'hash-table', 'arrays', 'leetcode'],
    'related_session' => 'length-of-longest-fibonacci-subsequence',
];

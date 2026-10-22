<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Non-overlapping Palindrome Substrings: DP that checks lengths k and k + 1',
    'leetcode' => 2472,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] is the most palindromes in the first i letters. Only palindromes of length k or k + 1 need checking: a longer one can be trimmed from both ends, freeing letters without losing the palindrome.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'string', 'dynamic-programming', 'greedy', 'leetcode'],
    'related_session' => 'maximum-number-of-non-overlapping-palindrome-substrings',
];

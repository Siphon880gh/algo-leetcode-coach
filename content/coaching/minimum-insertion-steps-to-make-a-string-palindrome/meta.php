<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Insertion Steps to Make a String Palindrome: interval DP',
    'leetcode' => 1312,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][j] is 0 for one character, equals dp[i + 1][j − 1] when the ends match, and is 1 + min(dp[i + 1][j], dp[i][j − 1]) otherwise. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-insertion-steps-to-make-a-string-palindrome',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Removal: interval DP',
    'leetcode' => 1246,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][j] for arr[i..j], with arr[i] removed alone, with an equal neighbour, or together with a later equal arr[k] at no extra cost. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'palindrome-removal',
    'tags' => ['dynamic-programming', 'step-by-step'],
];

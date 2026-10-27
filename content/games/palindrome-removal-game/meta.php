<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Removal: pair the first element with an equal one',
    'leetcode' => 1246,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = fewest moves to clear arr[i to j]. Remove arr[i] alone: 1 + dp[i+1][j]. If arr[i] == arr[i+1]: 1 + dp[i+2][j]. For k > i+1 with arr[k] == arr[i]: dp[i+1][k−1] + dp[k+1][j] (arr[i] and arr[k] ride on the last move inside).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'palindrome-removal',
    'related_session' => 'palindrome-removal',
];

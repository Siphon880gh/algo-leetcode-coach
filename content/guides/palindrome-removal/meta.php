<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Removal: interval DP on the first element',
    'leetcode' => 1246,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] is the fewest moves for arr[i..j]. arr[i] can go alone, pair with an equal neighbour, or ride along with a later equal arr[k] by being removed together with the last move on arr[i + 1..k − 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'palindrome-removal',
];

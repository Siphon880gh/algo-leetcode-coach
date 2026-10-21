<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Books You Can Take: monotonic stack on books[i] − i',
    'leetcode' => 2355,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] is the best ending at shelf i with all books[i] taken. Going left the take drops by 1 per shelf until it meets a shelf j with books[j] − j < books[i] − i; found with a monotonic stack, dp[i] = dp[j] + an arithmetic sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['array', 'stack', 'dynamic-programming', 'monotonic-stack', 'leetcode'],
    'related_session' => 'maximum-number-of-books-you-can-take',
];

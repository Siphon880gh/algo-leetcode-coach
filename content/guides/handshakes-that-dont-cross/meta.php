<?php
declare(strict_types=1);

return [
    'title' => 'Handshakes That Don\'t Cross: Catalan numbers',
    'leetcode' => 1259,
    'difficulty' => 'Hard',
    'summary' => 'Person 1\'s partner splits the circle into two independent sides, each with an even number of people. That gives the Catalan recurrence dp[i] = Σ dp[j] · dp[i − 1 − j] over pair counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'math', 'combinatorics', 'leetcode'],
    'related_session' => 'handshakes-that-dont-cross',
];

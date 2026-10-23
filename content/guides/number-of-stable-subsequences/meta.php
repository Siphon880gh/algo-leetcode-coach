<?php
declare(strict_types=1);

return [
    'title' => 'Number of Stable Subsequences: DP on last parity and run length',
    'leetcode' => 3686,
    'difficulty' => 'Hard',
    'summary' => 'Track subsequences by last parity and whether the last run is 1 or 2 long. A new element extends opposite-parity endings to run 1 and same-parity run-1 endings to run 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'number-of-stable-subsequences',
];

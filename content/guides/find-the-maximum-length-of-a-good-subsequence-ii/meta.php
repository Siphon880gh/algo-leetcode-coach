<?php
declare(strict_types=1);

return [
    'title' => 'Find the Maximum Length of a Good Subsequence II: DP by value',
    'leetcode' => 3177,
    'difficulty' => 'Hard',
    'summary' => 'Keep, for each value, the best length ending in it with j changes, plus the best over all values for each j. Each element updates its row from k down to 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'leetcode'],
    'related_session' => 'find-the-maximum-length-of-a-good-subsequence-ii',
];

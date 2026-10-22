<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score of Non-overlapping Intervals: DP that carries the index list',
    'leetcode' => 3414,
    'difficulty' => 'Hard',
    'summary' => 'Sort by start. dp[p][c] is the best (score, sorted index list) using intervals from position p on with at most c picks. Skip p, or take it and jump to the first start after its end; higher score wins, and ties go to the lexicographically smaller list.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'maximum-score-of-non-overlapping-intervals',
];

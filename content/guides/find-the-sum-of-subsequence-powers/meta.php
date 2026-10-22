<?php
declare(strict_types=1);

return [
    'title' => 'Find the Sum of Subsequence Powers: count by minimum gap',
    'leetcode' => 3098,
    'difficulty' => 'Hard',
    'summary' => 'Sort, so a subsequence’s power is its smallest adjacent gap. For each candidate gap d (a pairwise difference), count length-k subsequences whose adjacent gaps are all ≥ d. Summing (d − previous d) · count over increasing d adds up every power.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'find-the-sum-of-subsequence-powers',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Find Sorted Submatrices With Maximum Element at Most K: run widths and a monotonic stack',
    'leetcode' => 3359,
    'difficulty' => 'Hard',
    'summary' => 'w[i][j] = how far right from (i, j) the row stays non-increasing with values ≤ k. For each left column, submatrices are stacks of rows limited by the smallest w, counted with a monotonic stack.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'array', 'matrix', 'monotonic-stack', 'leetcode'],
    'related_session' => 'find-sorted-submatrices-with-maximum-element-at-most-k',
];

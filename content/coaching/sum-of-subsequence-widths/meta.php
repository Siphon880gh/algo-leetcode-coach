<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Subsequence Widths: each element as max and min',
    'leetcode' => 891,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort, then a[i] is the max of 2^i subsequences and the min of 2^(n−1−i), contributing a[i] · (2^i − 2^(n−1−i)). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'sum-of-subsequence-widths',
    'tags' => ['math', 'sorting', 'combinatorics', 'step-by-step'],
];

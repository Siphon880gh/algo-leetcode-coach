<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Subsequence Widths: count each element as max and as min',
    'leetcode' => 891,
    'difficulty' => 'Hard',
    'summary' => 'Order does not matter, so sort. After sorting, a[i] is the maximum of 2^i subsequences and the minimum of 2^(n − 1 − i), so it contributes a[i] · (2^i − 2^(n − 1 − i)).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'sorting', 'combinatorics', 'leetcode'],
    'related_session' => 'sum-of-subsequence-widths',
];

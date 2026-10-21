<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Average Difference: prefix sums with an empty right side',
    'leetcode' => 2256,
    'difficulty' => 'Med',
    'summary' => 'Keep a running prefix sum. At index i the left average is prefix / (i + 1) and the right average is (total − prefix) / (n − i − 1), or 0 when the right side is empty. Return the first index with the smallest absolute difference.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-average-difference',
];

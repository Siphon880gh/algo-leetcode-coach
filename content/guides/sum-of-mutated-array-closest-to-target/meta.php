<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Mutated Array Closest to Target: sort and try each cap',
    'leetcode' => 1300,
    'difficulty' => 'Med',
    'summary' => 'Sort the array and walk it with a prefix sum. Before index i, the cap v that spreads the rest evenly is (target − prefix) / (n − i); check its floor and ceiling while v stays at most arr[i], and prefer the smaller value on ties.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'binary-search', 'leetcode'],
    'related_session' => 'sum-of-mutated-array-closest-to-target',
];

<?php
declare(strict_types=1);

return [
    'title' => 'K Inverse Pairs Array: a sliding sum over the previous row',
    'leetcode' => 629,
    'difficulty' => 'Hard',
    'summary' => 'Placing the largest value i in a permutation of 1..i−1 adds 0 to i − 1 inverse pairs. So f[i][j] is a window sum of the previous row, kept in O(1) per cell with a prefix difference.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'math', 'leetcode'],
    'related_session' => 'k-inverse-pairs-array',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Balanced Permutations: choose digits for even slots',
    'leetcode' => 3343,
    'difficulty' => 'Hard',
    'summary' => 'The total digit sum must be even. Choose how many of each digit go to the ⌈n/2⌉ even slots so they sum to half the total; each choice gives (even slots)! · (odd slots)! / Π(a_d! · (c_d − a_d)!) arrangements.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['math', 'string', 'dynamic-programming', 'combinatorics', 'leetcode'],
    'related_session' => 'count-number-of-balanced-permutations',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Find the Derangement of an Array: D(n) = (n − 1)(D(n − 1) + D(n − 2))',
    'leetcode' => 634,
    'difficulty' => 'Med',
    'summary' => 'Count permutations with no fixed point. Element 1 goes to some position k (n − 1 choices); then either k goes to position 1, leaving D(n − 2), or it does not, which behaves like D(n − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'math', 'combinatorics', 'leetcode'],
    'related_session' => 'find-the-derangement-of-an-array',
];

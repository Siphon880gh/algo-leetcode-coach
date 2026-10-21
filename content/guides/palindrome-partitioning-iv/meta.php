<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Partitioning IV: palindrome table plus two cuts',
    'leetcode' => 1745,
    'difficulty' => 'Hard',
    'summary' => 'Precompute isPal[i][j] for all substrings, then try every pair of cuts i < j and check the three pieces.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'leetcode'],
    'related_session' => 'palindrome-partitioning-iv',
];

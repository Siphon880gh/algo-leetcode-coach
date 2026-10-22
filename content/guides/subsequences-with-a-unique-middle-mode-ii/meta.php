<?php
declare(strict_types=1);

return [
    'title' => 'Subsequences with a Unique Middle Mode II: running sums of count products',
    'leetcode' => 3416,
    'difficulty' => 'Hard',
    'summary' => 'Part I loops over every other value for each middle. Instead keep running sums of l_u · r_u, l_u · r_u², l_u² · r_u, l_u² and r_u² over all values, so each middle takes O(1) after removing its own value’s term.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'combinatorics', 'leetcode'],
    'related_session' => 'subsequences-with-a-unique-middle-mode-ii',
];

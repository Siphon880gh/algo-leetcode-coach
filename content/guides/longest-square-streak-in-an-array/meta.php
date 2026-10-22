<?php
declare(strict_types=1);

return [
    'title' => 'Longest Square Streak in an Array: follow squares through a set',
    'leetcode' => 2501,
    'difficulty' => 'Med',
    'summary' => 'Order does not matter, since the streak is sorted afterwards. Put the values in a set, and from each value keep squaring while the square is present; the longest chain of at least 2 wins.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'binary-search', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'longest-square-streak-in-an-array',
];

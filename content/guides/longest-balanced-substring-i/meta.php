<?php
declare(strict_types=1);

return [
    'title' => 'Longest Balanced Substring I: grow from each start',
    'leetcode' => 3713,
    'difficulty' => 'Med',
    'summary' => 'n is small, so try every start. Grow the end while tracking counts, the number of distinct letters and the largest count. The substring is balanced when largest count × distinct = length.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'counting', 'enumeration', 'leetcode'],
    'related_session' => 'longest-balanced-substring-i',
];

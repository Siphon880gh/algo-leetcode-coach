<?php
declare(strict_types=1);

return [
    'title' => 'Find the Kth Largest Integer in the Array: compare by length, then lexicographically',
    'leetcode' => 1985,
    'difficulty' => 'Med',
    'summary' => 'The strings have no leading zeros, so a longer string is a larger number and equal lengths compare lexicographically. Sort with key (length, string) descending, or use a size-k heap / quickselect.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'heap', 'string', 'leetcode'],
    'related_session' => 'find-the-kth-largest-integer-in-the-array',
];

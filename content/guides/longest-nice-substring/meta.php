<?php
declare(strict_types=1);

return [
    'title' => 'Longest Nice Substring: split on a lonely letter',
    'leetcode' => 1763,
    'difficulty' => 'Easy',
    'summary' => 'If some character lacks its other case anywhere in s, no nice substring can contain it, so split there and recurse on both sides; a string with no lonely character is nice.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'kind' => 'algo',
    'tags' => ['divide-and-conquer', 'string', 'hash-set', 'leetcode'],
    'related_session' => 'longest-nice-substring',
];

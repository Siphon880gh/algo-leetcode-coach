<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Matching Substring: for each middle piece, nearest outer pieces',
    'leetcode' => 3455,
    'difficulty' => 'Hard',
    'summary' => 'Split p into a, b, c at the stars and find every occurrence of each (KMP or Z-function; an empty piece occurs everywhere). For each b at j, use the last a ending by j and the first c starting after b; the length is c’s end minus a’s start.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'string', 'binary-search', 'string-matching', 'leetcode'],
    'related_session' => 'shortest-matching-substring',
];

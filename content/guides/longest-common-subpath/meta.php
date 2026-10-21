<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Subpath: binary search + rolling hash',
    'leetcode' => 1923,
    'difficulty' => 'Hard',
    'summary' => 'If a common subpath of length L exists, one of length L − 1 does too. Binary search L; for each L, hash every window of every path (double rolling hash) and intersect the hash sets.',
    'category' => 'LeetCode',
    'subcategory' => 'Rolling Hash',
    'topic' => 'LeetCode · Rolling Hash',
    'kind' => 'algo',
    'tags' => ['rolling-hash', 'binary-search', 'suffix-array', 'leetcode'],
    'related_session' => 'longest-common-subpath',
];

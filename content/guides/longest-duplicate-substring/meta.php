<?php
declare(strict_types=1);

return [
    'title' => 'Longest Duplicate Substring: binary search on length with hashing',
    'leetcode' => 1044,
    'difficulty' => 'Hard',
    'summary' => 'If a duplicate of length L exists, one of length L − 1 does too. Binary search L, and test each length with a rolling hash over all windows, confirming matches to rule out collisions.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'kind' => 'algo',
    'tags' => ['strings', 'binary-search', 'rolling-hash', 'suffix-array', 'leetcode'],
    'related_session' => 'longest-duplicate-substring',
];

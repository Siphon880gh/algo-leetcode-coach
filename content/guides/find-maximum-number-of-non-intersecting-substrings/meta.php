<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Number of Non Intersecting Substrings: greedy earliest end',
    'leetcode' => 3557,
    'difficulty' => 'Med',
    'summary' => 'Take a substring as soon as one can end: scan, remember the first index of each letter since the last pick, and when the current letter was first seen at least 3 positions back, count one and clear the memory.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-table', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'find-maximum-number-of-non-intersecting-substrings',
];

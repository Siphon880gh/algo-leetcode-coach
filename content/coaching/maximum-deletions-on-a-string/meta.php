<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Deletions on a String: try every repeat, delete-all is 1, use an LCP table',
    'leetcode' => 2430,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: try every repeat length instead of the shortest, count deleting the whole rest as one operation, and check repeats with a longest-common-prefix table. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-deletions-on-a-string',
    'tags' => ['string', 'dynamic-programming', 'string-matching', 'hash-function', 'rolling-hash', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Valid Strings to Form Target II: Z-function reach, then jump game',
    'leetcode' => 3292,
    'difficulty' => 'Hard',
    'summary' => 'Any prefix of a word is valid, so from i every end up to reach[i] works. Get reach[i] for all i with one Z-function per word over word + # + target, then solve a jump game greedily.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['greedy', 'segment-tree', 'array', 'string', 'binary-search', 'dynamic-programming', 'string-matching', 'hash-function', 'rolling-hash', 'leetcode'],
    'related_session' => 'minimum-number-of-valid-strings-to-form-target-ii',
];

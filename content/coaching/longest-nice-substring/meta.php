<?php
declare(strict_types=1);

return [
    'title' => 'Longest Nice Substring: split on a lonely letter',
    'leetcode' => 1763,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: find a character whose other case is absent in the string, split there, recurse on both sides, and return the longer (left on ties). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'related_guide' => 'longest-nice-substring',
    'tags' => ['divide-and-conquer', 'string', 'hash-set', 'step-by-step'],
];

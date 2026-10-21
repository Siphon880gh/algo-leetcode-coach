<?php
declare(strict_types=1);

return [
    'title' => 'Count Unique Characters of All Substrings: per-character contribution',
    'leetcode' => 828,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: a character at i is unique in substrings spanning i but neither neighboring occurrence of its letter, giving (i − prev) · (next − i). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'count-unique-characters-of-all-substrings-of-a-given-string',
    'tags' => ['dynamic-programming', 'strings', 'math', 'step-by-step'],
];

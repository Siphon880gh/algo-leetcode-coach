<?php
declare(strict_types=1);

return [
    'title' => 'Find All Good Strings: digit DP with KMP',
    'leetcode' => 1397,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: build the string left to right with state (position, matched evil prefix, low tight, high tight), using KMP to update the match. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'find-all-good-strings',
    'tags' => ['dynamic-programming', 'kmp', 'strings', 'step-by-step'],
];

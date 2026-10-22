<?php
declare(strict_types=1);

return [
    'title' => 'The Number of Beautiful Subsets: check both sides, drop the empty set',
    'leetcode' => 2597,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: block a value when value − k or value + k is chosen, and subtract 1 for the empty subset. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'the-number-of-beautiful-subsets',
    'tags' => ['array', 'hash-table', 'math', 'dynamic-programming', 'backtracking', 'sorting', 'combinatorics', 'step-by-step'],
];

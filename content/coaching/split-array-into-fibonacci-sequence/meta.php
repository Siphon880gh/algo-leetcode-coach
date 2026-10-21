<?php
declare(strict_types=1);

return [
    'title' => 'Split Array into Fibonacci Sequence: choose two, the rest is forced',
    'leetcode' => 842,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: try every first and second number; after that each next number must be the sum, so just check it matches the string. Reject leading zeros and values above 2³¹ − 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'split-array-into-fibonacci-sequence',
    'tags' => ['backtracking', 'strings', 'math', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Rows Covered by Columns: every 1 chosen, empty rows count, no greedy',
    'leetcode' => 2397,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: require every 1 of a row to be in a chosen column, count rows of zeros as covered, and try every column set instead of greedy picks. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'maximum-rows-covered-by-columns',
    'tags' => ['array', 'backtracking', 'bit-manipulation', 'matrix', 'enumeration', 'step-by-step'],
];

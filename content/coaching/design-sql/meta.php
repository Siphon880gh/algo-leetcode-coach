<?php
declare(strict_types=1);

return [
    'title' => 'Design SQL: ids never reused, reject bad rows, check every index',
    'leetcode' => 2408,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a per-table id counter that survives removals, reject rows of the wrong length without inserting, and check table, row and column before reading a cell. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-sql',
    'tags' => ['array', 'hash-table', 'string', 'design', 'step-by-step'],
];

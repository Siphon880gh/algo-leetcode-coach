<?php
declare(strict_types=1);

return [
    'title' => 'Election Results: split votes in real numbers',
    'leetcode' => 2820,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: weight each row by 1.0 over the voter’s row count, then keep the top totals. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'election-results',
    'tags' => ['database', 'sql', 'window-functions', 'step-by-step'],
];

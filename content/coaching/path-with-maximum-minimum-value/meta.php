<?php
declare(strict_types=1);

return [
    'title' => 'Path With Maximum Minimum Value: best-first search',
    'leetcode' => 1102,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: expand from the start with a max-heap on cell value, track the smallest value taken so far, and stop when the bottom-right cell is popped. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'path-with-maximum-minimum-value',
    'tags' => ['graphs', 'heap', 'union-find', 'binary-search', 'step-by-step'],
];

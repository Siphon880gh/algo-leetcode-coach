<?php
declare(strict_types=1);

return [
    'title' => 'Magic Squares In Grid: center 5, digits 1–9, lines sum to 15',
    'leetcode' => 840,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each 3 × 3 window, require the distinct digits 1 to 9, reject fast unless the center is 5, then check all eight lines sum to 15. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'related_guide' => 'magic-squares-in-grid',
    'tags' => ['arrays', 'matrix', 'math', 'step-by-step'],
];

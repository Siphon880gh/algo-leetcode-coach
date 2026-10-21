<?php
declare(strict_types=1);

return [
    'title' => 'Number Of Corner Rectangles: pairs of shared columns',
    'leetcode' => 750,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each pair of rows, count the columns where both are 1, and add c · (c − 1) / 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-corner-rectangles',
    'tags' => ['dynamic-programming', 'math', 'matrix', 'hash-map', 'step-by-step'],
];

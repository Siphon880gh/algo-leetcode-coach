<?php
declare(strict_types=1);

return [
    'title' => 'Largest Magic Square: largest size first',
    'leetcode' => 1895,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: try k from large to small, check all row, column and diagonal sums with prefix sums, return the first hit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'related_guide' => 'largest-magic-square',
    'tags' => ['matrix', 'prefix-sum', 'enumeration', 'step-by-step'],
];

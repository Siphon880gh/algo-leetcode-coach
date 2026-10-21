<?php
declare(strict_types=1);

return [
    'title' => 'Tuple with Same Product: count equal-product pairs',
    'leetcode' => 1726,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count products over all index pairs i < j; each product shared by c pairs gives C(c, 2) · 8 tuples. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'tuple-with-same-product',
    'tags' => ['hash-map', 'math', 'counting', 'step-by-step'],
];

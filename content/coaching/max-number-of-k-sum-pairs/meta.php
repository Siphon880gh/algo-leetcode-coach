<?php
declare(strict_types=1);

return [
    'title' => 'Max K-Sum Pairs: waiting-value counter',
    'leetcode' => 1679,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each x, if k − x is waiting, consume it and count a pair; otherwise store x. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'max-number-of-k-sum-pairs',
    'tags' => ['hash-map', 'two-pointers', 'sorting', 'step-by-step'],
];

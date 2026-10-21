<?php
declare(strict_types=1);

return [
    'title' => 'Dot Product of Two Sparse Vectors: non-zero pairs',
    'leetcode' => 1570,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: store sorted (index, value) pairs for non-zeros; merge two lists with two pointers, adding products on equal indices. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'dot-product-of-two-sparse-vectors',
    'tags' => ['design', 'hash-map', 'two-pointers', 'step-by-step'],
];

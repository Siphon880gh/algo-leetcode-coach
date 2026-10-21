<?php
declare(strict_types=1);

return [
    'title' => 'Equivalent Expression Trees: leaf counts',
    'leetcode' => 1612,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: with only +, each tree is the multiset of its leaves; add counts for one tree, subtract for the other, and check all zero. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'check-if-two-expression-trees-are-equivalent',
    'tags' => ['tree', 'depth-first-search', 'hash-map', 'step-by-step'],
];

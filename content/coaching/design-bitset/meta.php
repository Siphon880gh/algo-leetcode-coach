<?php
declare(strict_types=1);

return [
    'title' => 'Design Bitset: constant-time flip',
    'leetcode' => 2166,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a complement copy so flip is a swap, keep a running count, and only change the count when a bit really changes. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-bitset',
    'tags' => ['array', 'hash-table', 'string', 'design', 'step-by-step'],
];

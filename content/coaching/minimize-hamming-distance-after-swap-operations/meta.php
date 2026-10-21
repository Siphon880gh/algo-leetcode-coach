<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Hamming Distance After Swap Operations: components as multisets',
    'leetcode' => 1722,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: union indices joined by allowed swaps; within each component the source values can be permuted freely, so count source values per component and match targets against them. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'minimize-hamming-distance-after-swap-operations',
    'tags' => ['union-find', 'hash-map', 'step-by-step'],
];

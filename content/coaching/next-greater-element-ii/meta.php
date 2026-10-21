<?php
declare(strict_types=1);

return [
    'title' => 'Next Greater Element II: monotonic stack over two passes for the wrap',
    'leetcode' => 503,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: circular next greater element. Run a monotonic stack over indexes 0..2n − 1 with i mod n, so each element also sees the ones before it. [1,2,1] → [2,−1,2]. Not 496 / 739. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['monotonic-stack', 'stack', 'arrays', 'step-by-step'],
    'related_guide' => 'next-greater-element-ii',
];

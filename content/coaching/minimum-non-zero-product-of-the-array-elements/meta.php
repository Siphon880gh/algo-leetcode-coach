<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Non-Zero Product: pair into 1 and max − 1',
    'leetcode' => 1969,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: answer = mx · (mx − 1)^((mx − 1) / 2) mod p, mx = 2^p − 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'minimum-non-zero-product-of-the-array-elements',
    'tags' => ['math', 'greedy', 'fast-power', 'step-by-step'],
];

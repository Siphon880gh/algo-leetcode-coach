<?php
declare(strict_types=1);

return [
    'title' => 'Make Sum Divisible by P: prefix remainders',
    'leetcode' => 1590,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: need = total mod p; find the shortest subarray with sum ≡ need using a map of last index per prefix remainder; the whole array is not allowed. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'make-sum-divisible-by-p',
    'tags' => ['prefix-sum', 'hash-map', 'step-by-step'],
];

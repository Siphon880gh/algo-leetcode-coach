<?php
declare(strict_types=1);

return [
    'title' => 'Apply Operations to Make Two Strings Equal: parity, then DP',
    'leetcode' => 2896,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: odd mismatches → −1; otherwise DP choosing x/2 per mismatch or the distance to the previous one. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'apply-operations-to-make-two-strings-equal',
    'tags' => ['string', 'dynamic-programming', 'step-by-step'],
];

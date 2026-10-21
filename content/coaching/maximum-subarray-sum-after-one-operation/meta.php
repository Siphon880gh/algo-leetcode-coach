<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum After One Operation: Kadane with a used flag',
    'leetcode' => 1746,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep plain (best ending here, no square) and sq (best ending here, one square used); sq = max(sq + x, plain + x², x²), then plain = max(plain + x, x); answer max sq. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-subarray-sum-after-one-operation',
    'tags' => ['dynamic-programming', 'array', 'step-by-step'],
];

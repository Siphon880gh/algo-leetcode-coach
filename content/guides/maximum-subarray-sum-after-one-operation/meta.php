<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum After One Operation: Kadane with a used flag',
    'leetcode' => 1746,
    'difficulty' => 'Med',
    'summary' => 'Run Kadane with two states: best subarray ending here without squaring, and with exactly one square used. The squared state extends itself with x or the plain state with x².',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'maximum-subarray-sum-after-one-operation',
];

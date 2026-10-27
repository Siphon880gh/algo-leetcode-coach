<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product Subarray: a negative swaps max and min',
    'leetcode' => 152,
    'difficulty' => 'Med',
    'summary' => 'Track the largest and smallest product ending here. A negative x turns the smallest into the largest, so swap them first. Then hi = max(x, hi times x), lo = min(x, lo times x).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['kadane', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-product-subarray',
    'related_session' => 'maximum-product-subarray',
];

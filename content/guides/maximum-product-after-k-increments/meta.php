<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product After K Increments: always raise the smallest',
    'leetcode' => 2233,
    'difficulty' => 'Med',
    'summary' => 'Incrementing the smallest number gives the biggest relative gain. Use a min-heap: k times, pop the smallest and push it back plus one; then multiply mod 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'heap', 'leetcode'],
    'related_session' => 'maximum-product-after-k-increments',
];

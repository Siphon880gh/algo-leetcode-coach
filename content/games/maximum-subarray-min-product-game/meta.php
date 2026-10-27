<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Min-Product',
    'leetcode' => 1856,
    'difficulty' => 'Med',
    'summary' => 'Treat each element as the minimum: monotonic stacks give the widest span where it is the min; prefix sums give that span\'s sum. Maximize min times sum, then mod 1e9+7.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-min-product',
    'related_session' => 'maximum-subarray-min-product',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Semi-Decreasing Subarrays',
    'leetcode' => 2863,
    'difficulty' => 'Med',
    'summary' => 'Need first > last. Keep a stack of strictly increasing prefix maxima as candidate left ends; scan j from the right and pop every left end bigger than nums[j], measuring j − i + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-length-of-semi-decreasing-subarrays',
    'related_session' => 'maximum-length-of-semi-decreasing-subarrays',
];

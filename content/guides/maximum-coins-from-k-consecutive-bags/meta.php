<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Coins From K Consecutive Bags: windows that touch a segment end',
    'leetcode' => 3413,
    'difficulty' => 'Med',
    'summary' => 'A best window can be slid until it starts at some segment’s left end or ends at some segment’s right end. Sort the segments and use two pointers for windows starting at each l, then repeat on the mirrored line for windows ending at each r.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'binary-search', 'prefix-sum', 'sorting', 'sliding-window', 'leetcode'],
    'related_session' => 'maximum-coins-from-k-consecutive-bags',
];

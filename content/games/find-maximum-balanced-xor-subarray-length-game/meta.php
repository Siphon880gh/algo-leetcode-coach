<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Balanced XOR Subarray Length',
    'leetcode' => 3755,
    'difficulty' => 'Med',
    'summary' => 'Track the prefix XOR and the prefix (evens − odds). A subarray works when both prefix values repeat, so store the first index of each pair in a hash map and measure the distance when it shows up again.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-maximum-balanced-xor-subarray-length',
    'related_session' => 'find-maximum-balanced-xor-subarray-length',
];

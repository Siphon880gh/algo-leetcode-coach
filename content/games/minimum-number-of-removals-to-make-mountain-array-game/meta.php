<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Removals to Make Mountain Array: LIS in, LDS out',
    'leetcode' => 1671,
    'difficulty' => 'Hard',
    'summary' => 'inc[i] = LIS ending at i; dec[i] = longest decreasing run starting at i (LIS from the right). A peak needs both > 1. Removals = n − max(inc + dec − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-removals-to-make-mountain-array',
    'related_session' => 'minimum-number-of-removals-to-make-mountain-array',
];

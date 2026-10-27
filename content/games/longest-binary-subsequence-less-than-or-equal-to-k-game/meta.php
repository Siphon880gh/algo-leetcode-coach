<?php
declare(strict_types=1);

return [
    'title' => 'Longest Binary Subsequence at most k: all zeros, plus cheap ones from the right',
    'leetcode' => 2311,
    'difficulty' => 'Med',
    'summary' => 'Every 0 is free. Scan from the right: a 1 at bit position p is kept if adding 2 to the power p keeps the value at most k (positions count kept characters).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-binary-subsequence-less-than-or-equal-to-k',
    'related_session' => 'longest-binary-subsequence-less-than-or-equal-to-k',
];

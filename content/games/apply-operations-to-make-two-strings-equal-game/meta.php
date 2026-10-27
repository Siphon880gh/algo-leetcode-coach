<?php
declare(strict_types=1);

return [
    'title' => 'Apply Operations to Make Two Strings Equal: pair up the mismatches',
    'leetcode' => 2896,
    'difficulty' => 'Med',
    'summary' => 'List mismatch positions p. An odd count is impossible. Fix pairs either with any-two flips (cost x per pair, x divided by 2 per mismatch) or neighbor-chain flips (cost p[i] − p[i−1]). dp[i] = min(dp[i−1] + x divided by 2, dp[i−2] + p[i] − p[i−1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'apply-operations-to-make-two-strings-equal',
    'related_session' => 'apply-operations-to-make-two-strings-equal',
];

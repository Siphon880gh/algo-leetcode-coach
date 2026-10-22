<?php
declare(strict_types=1);

return [
    'title' => 'Decode Ways: one digit or two',
    'leetcode' => 91,
    'difficulty' => 'Med',
    'summary' => 'dp[i] counts decodings of the first i digits. A valid single digit (1–9) adds dp[i−1]. A valid pair (10–26) adds dp[i−2]. A "0" alone adds nothing.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'decode-ways',
    'related_session' => 'decode-ways',
];

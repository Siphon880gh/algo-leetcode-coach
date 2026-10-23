<?php
declare(strict_types=1);

return [
    'title' => 'Integer Break: split off j, keep or break the rest',
    'leetcode' => 343,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = max over j of j · max(i − j, dp[i − j]). Each part is either kept whole or broken further.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'integer-break',
    'related_session' => 'integer-break',
];

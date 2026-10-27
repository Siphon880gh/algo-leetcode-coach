<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Build Good Strings: append a zero-block or a one-block',
    'leetcode' => 2466,
    'difficulty' => 'Med',
    'summary' => 'dp[len] = strings of exactly that length = dp[len − zero] + dp[len − one]. Sum dp over low to high.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-ways-to-build-good-strings',
    'related_session' => 'count-ways-to-build-good-strings',
];

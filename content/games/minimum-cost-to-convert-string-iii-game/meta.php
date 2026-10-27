<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Convert String III',
    'leetcode' => 3995,
    'difficulty' => 'Hard',
    'summary' => 'Every position is used at most once, so rules always match against the original source. dp[i] = cheapest way to fix the prefix of length i: copy one character if source[i] already equals target[i], or apply a rule starting at i whose pattern matches source (\'*\' matches anything) and whose replacement equals target there, paying its cost plus its wildcards.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-convert-string-iii',
    'related_session' => 'minimum-cost-to-convert-string-iii',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Extra Characters in a String',
    'leetcode' => 2707,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = fewest extra characters in s[i..]. Either skip s[i] (1 + dp[i+1]) or, walking a trie from i, jump past any dictionary word: dp[j+1].',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'extra-characters-in-a-string',
    'related_session' => 'extra-characters-in-a-string',
];

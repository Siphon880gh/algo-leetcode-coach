<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Valid Strings to Form Target I',
    'leetcode' => 3291,
    'difficulty' => 'Med',
    'summary' => 'Trie of all words. dp[i] = min pieces for target[..i]; from each reachable i, walk the trie along target[i..] and relax dp[j] for every node reached (each node is a valid prefix).',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-valid-strings-to-form-target-i',
    'related_session' => 'minimum-number-of-valid-strings-to-form-target-i',
];

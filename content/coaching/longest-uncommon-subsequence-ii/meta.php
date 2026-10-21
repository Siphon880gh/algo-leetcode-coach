<?php
declare(strict_types=1);

return [
    'title' => 'Longest Uncommon Subsequence II: test each whole string against the others',
    'leetcode' => 522,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: longest subsequence of exactly one string in strs. Only whole strings matter: for each s, check it is not a subsequence of any other (two pointers); return the max length or −1. ["aba","cdc","eae"] → 3. ["aaa","aaa","aa"] → −1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'two-pointers', 'sorting', 'step-by-step'],
    'related_guide' => 'longest-uncommon-subsequence-ii',
];

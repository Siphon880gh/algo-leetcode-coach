<?php
declare(strict_types=1);

return [
    'title' => 'Longest Uncommon Subsequence II: test each whole string against the others',
    'leetcode' => 522,
    'difficulty' => 'Med',
    'summary' => 'Longest string that is a subsequence of exactly one string in strs, or −1. If any uncommon subsequence exists, the whole string it came from is also uncommon. So for each s, check with two pointers that it is not a subsequence of any other string; return the max such length. ["aba","cdc","eae"] → 3. ["aaa","aaa","aa"] → −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'two-pointers', 'sorting', 'leetcode'],
    'related_session' => 'longest-uncommon-subsequence-ii',
];

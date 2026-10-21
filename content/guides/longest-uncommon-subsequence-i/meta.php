<?php
declare(strict_types=1);

return [
    'title' => 'Longest Uncommon Subsequence I: equal strings → −1, else the longer length',
    'leetcode' => 521,
    'difficulty' => 'Easy',
    'summary' => 'An uncommon subsequence is one of the strings that is not a subsequence of the other. If a == b, none exists → −1. Otherwise the longer string (either one if same length) cannot be a subsequence of the other, so return max(len(a), len(b)). "aba", "cdc" → 3. "aaa", "aaa" → −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'leetcode'],
    'related_session' => 'longest-uncommon-subsequence-i',
];

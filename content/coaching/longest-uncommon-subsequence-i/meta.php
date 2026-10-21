<?php
declare(strict_types=1);

return [
    'title' => 'Longest Uncommon Subsequence I: equal strings → −1, else the longer length',
    'leetcode' => 521,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: longest string that is a subsequence of exactly one of a and b. If a == b → −1; else max(len(a), len(b)). "aba", "cdc" → 3. "aaa", "aaa" → −1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'step-by-step'],
    'related_guide' => 'longest-uncommon-subsequence-i',
];

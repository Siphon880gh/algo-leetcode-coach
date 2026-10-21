<?php
declare(strict_types=1);

return [
    'title' => 'Longest Harmonious Subsequence: x and x + 1',
    'leetcode' => 594,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: a subsequence only needs counts, and a harmonious one uses exactly two adjacent values, so try cnt[x] + cnt[x + 1]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'longest-harmonious-subsequence',
    'tags' => ['hash-table', 'arrays', 'counting', 'sorting', 'step-by-step'],
];

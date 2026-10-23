<?php
declare(strict_types=1);

return [
    'title' => 'Select k Disjoint Special Substrings: closed intervals, then greedy',
    'leetcode' => 3458,
    'difficulty' => 'Med',
    'summary' => 'From each letter\'s first occurrence, expand [first, last] until it contains every occurrence of every letter inside; if that never reaches back before the start, it is a candidate (unless it is the whole string). Pick disjoint candidates greedily by right end.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'select-k-disjoint-special-substrings',
    'related_session' => 'select-k-disjoint-special-substrings',
];

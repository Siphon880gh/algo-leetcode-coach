<?php
declare(strict_types=1);

return [
    'title' => 'Longest Chunked Palindrome Decomposition: shortest equal ends',
    'leetcode' => 1147,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: grow a prefix chunk until it equals the suffix chunk of the same length, count 2, peel both, and count 1 for any leftover middle. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'longest-chunked-palindrome-decomposition',
    'tags' => ['greedy', 'strings', 'two-pointers', 'rolling-hash', 'step-by-step'],
];

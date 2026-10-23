<?php
declare(strict_types=1);

return [
    'title' => 'Number of Wonderful Substrings',
    'leetcode' => 1915,
    'difficulty' => 'Med',
    'summary' => 'Keep counts of 10-bit parity masks seen so far. At each position add count[mask] (all even) plus count[mask ^ (1 << c)] for each letter c (exactly one odd).',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-wonderful-substrings',
    'related_session' => 'number-of-wonderful-substrings',
];

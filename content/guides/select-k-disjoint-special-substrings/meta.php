<?php
declare(strict_types=1);

return [
    'title' => 'Select K Disjoint Special Substrings: closed letter intervals, then interval scheduling',
    'leetcode' => 3458,
    'difficulty' => 'Med',
    'summary' => 'A minimal special substring starts at the first occurrence of some letter and must stretch to cover every letter it contains. Build that closure for each letter, drop it if it reaches a letter seen earlier or is the whole string, and pick as many disjoint ones as possible by earliest end.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-table', 'string', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'select-k-disjoint-special-substrings',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Longest String Chain: DP over words sorted by length',
    'leetcode' => 1048,
    'difficulty' => 'Med',
    'summary' => 'A word\'s predecessor is the word with one letter removed. Process words by length, and for each one try every single deletion, extending the best chain found for that shorter word.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'hash-table', 'strings', 'sorting', 'leetcode'],
    'related_session' => 'longest-string-chain',
];

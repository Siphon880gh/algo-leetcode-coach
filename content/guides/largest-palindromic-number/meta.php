<?php
declare(strict_types=1);

return [
    'title' => 'Largest Palindromic Number: pairs from 9 down, best middle',
    'leetcode' => 2384,
    'difficulty' => 'Med',
    'summary' => 'Count digits. Build the left half from pairs of the largest digits first, drop it if it would start with 0, put the largest leftover odd digit in the middle, and mirror. If nothing remains, the answer is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'greedy', 'counting', 'leetcode'],
    'related_session' => 'largest-palindromic-number',
];

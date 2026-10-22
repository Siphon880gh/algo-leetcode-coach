<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Good Subsequences: fix the common frequency',
    'leetcode' => 2539,
    'difficulty' => 'Med',
    'summary' => 'Fix the shared frequency f. Each letter with count c either stays out or contributes one of C(c, f) position sets, so f gives the product of (1 + C(c, f)) minus 1 for the empty choice. Sum over f.',
    'category' => 'LeetCode',
    'subcategory' => 'Combinatorics',
    'topic' => 'LeetCode · Combinatorics',
    'kind' => 'algo',
    'tags' => ['hash-table', 'math', 'string', 'combinatorics', 'counting', 'leetcode'],
    'related_session' => 'count-the-number-of-good-subsequences',
];

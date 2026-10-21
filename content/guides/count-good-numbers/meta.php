<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Numbers: fast power',
    'leetcode' => 1922,
    'difficulty' => 'Med',
    'summary' => 'Even indices have 5 choices (0, 2, 4, 6, 8) and odd indices 4 (2, 3, 5, 7). There are ceil(n / 2) even and floor(n / 2) odd positions: answer = 5^ceil(n/2) · 4^floor(n/2) mod p.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'fast-power', 'recursion', 'leetcode'],
    'related_session' => 'count-good-numbers',
];

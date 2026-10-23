<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score with Co-Prime Element: count sharers with Möbius',
    'leetcode' => 3953,
    'difficulty' => 'Hard',
    'summary' => 'Anything that clashes with the chosen value can be changed to 1 for cost 1. So for a value v you pay for every other element sharing a prime with v. Count sharers by inclusion-exclusion over the prime factors of v, for every kept value and every new value up to maxVal.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'combinatorics', 'enumeration', 'number-theory', 'leetcode'],
    'related_session' => 'maximum-score-with-co-prime-element',
];

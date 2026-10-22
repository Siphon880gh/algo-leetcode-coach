<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Split Into Subarrays With GCD Greater Than One: extend while the GCD stays above 1',
    'leetcode' => 2436,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right keeping the GCD of the current piece. When adding a number would drop it to 1, start a new piece at that number; stretching each piece as far as possible gives the fewest pieces.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'greedy', 'number-theory', 'leetcode'],
    'related_session' => 'minimum-split-into-subarrays-with-gcd-greater-than-one',
];

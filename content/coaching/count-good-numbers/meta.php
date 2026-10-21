<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Numbers: fast exponentiation',
    'leetcode' => 1922,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: 5 choices on even indices, 4 on odd; multiply 5^ceil(n/2) by 4^floor(n/2) mod p. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'count-good-numbers',
    'tags' => ['math', 'fast-power', 'recursion', 'step-by-step'],
];

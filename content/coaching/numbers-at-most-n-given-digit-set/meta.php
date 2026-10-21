<?php
declare(strict_types=1);

return [
    'title' => 'Numbers At Most N Given Digit Set: shorter, then digit by digit',
    'leetcode' => 902,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count all shorter numbers, then go along n\'s digits adding smaller choices times the free positions, and add 1 if n itself can be formed. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'numbers-at-most-n-given-digit-set',
    'tags' => ['math', 'dynamic-programming', 'digit-dp', 'step-by-step'],
];

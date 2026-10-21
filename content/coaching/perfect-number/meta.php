<?php
declare(strict_types=1);

return [
    'title' => 'Perfect Number: sum divisor pairs up to sqrt(num)',
    'leetcode' => 507,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: is num the sum of its proper divisors? Sum divisor pairs i and num / i for i up to sqrt(num), starting from 1, and treat num = 1 as false. 28 → true. 7 → false. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'step-by-step'],
    'related_guide' => 'perfect-number',
];

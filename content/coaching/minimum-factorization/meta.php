<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Factorization: big digits first, smallest number last',
    'leetcode' => 625,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: divide by 9 down to 2, fail if a factor above 7 remains, and write the digits in increasing order with an overflow check. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'minimum-factorization',
    'tags' => ['math', 'greedy', 'step-by-step'],
];

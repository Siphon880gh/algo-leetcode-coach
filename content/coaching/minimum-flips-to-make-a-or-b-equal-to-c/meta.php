<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Flips to Make a OR b Equal to c: bit costs',
    'leetcode' => 1318,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each bit, if c has 0 add the number of 1s among a\'s and b\'s bits; if c has 1 and both are 0, add 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'minimum-flips-to-make-a-or-b-equal-to-c',
    'tags' => ['bit-manipulation', 'step-by-step'],
];

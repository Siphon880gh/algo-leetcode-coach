<?php
declare(strict_types=1);

return [
    'title' => 'Adding Two Negabinary Numbers: negative carry',
    'leetcode' => 1073,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: add column by column from the right with s = a + b + carry, write s & 1, set carry = −(s − digit) / 2, then strip leading zeros. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'adding-two-negabinary-numbers',
    'tags' => ['math', 'arrays', 'step-by-step'],
];

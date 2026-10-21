<?php
declare(strict_types=1);

return [
    'title' => 'Steps to Reduce a Binary Number to One: carry scan',
    'leetcode' => 1404,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: scan from the last bit to the second, with a carry; an effective 1 costs two steps and sets the carry, an effective 0 or 2 costs one; add the final carry. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'number-of-steps-to-reduce-a-number-in-binary-representation-to-one',
    'tags' => ['bit-manipulation', 'strings', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Convert Binary Number in a Linked List to Integer: shift and OR',
    'leetcode' => 1290,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: the head is the most significant bit, so walk the list doing v = (v << 1) | bit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'related_guide' => 'convert-binary-number-in-a-linked-list-to-integer',
    'tags' => ['linked-list', 'bit-manipulation', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Number of Steps to Reduce a Number in Binary Representation to One: carry scan',
    'leetcode' => 1404,
    'difficulty' => 'Med',
    'summary' => 'Scan bits from the right, ignoring the leading bit, with a carry. A bit that is effectively 0 costs one step (halve); one that is effectively 1 costs two (add 1, then halve) and sets the carry. A final carry adds one step.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'strings', 'leetcode'],
    'related_session' => 'number-of-steps-to-reduce-a-number-in-binary-representation-to-one',
];

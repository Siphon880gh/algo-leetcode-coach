<?php
declare(strict_types=1);

return [
    'title' => 'Number of Steps to Reduce a Number in Binary Representation to One',
    'leetcode' => 1404,
    'difficulty' => 'Med',
    'summary' => 'Scan from the lowest bit up to (not including) the top with a carry: if bit + carry is 1, it is odd → add 1 then halve (2 steps, carry = 1); otherwise 1 step. Add the final carry.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bits', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-steps-to-reduce-a-number-in-binary-representation-to-one',
    'related_session' => 'number-of-steps-to-reduce-a-number-in-binary-representation-to-one',
];

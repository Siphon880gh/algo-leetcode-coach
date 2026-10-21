<?php
declare(strict_types=1);

return [
    'title' => 'Binary Gap: distance between consecutive 1 bits',
    'leetcode' => 868,
    'difficulty' => 'Easy',
    'summary' => 'Scan the bits from low to high, remembering the position of the last 1. Each new 1 gives a gap of i − last; return the largest, or 0 if there are fewer than two 1s.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'leetcode'],
    'related_session' => 'binary-gap',
];

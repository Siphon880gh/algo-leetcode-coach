<?php
declare(strict_types=1);

return [
    'title' => 'IP to CIDR: take the largest aligned block each time',
    'leetcode' => 751,
    'difficulty' => 'Med',
    'summary' => 'Convert the IP to a 32-bit integer. Repeatedly take the largest power-of-two block that starts at the current address (limited by its lowest set bit) and does not exceed the remaining count, emit it, and advance.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'strings', 'leetcode'],
    'related_session' => 'ip-to-cidr',
];

<?php
declare(strict_types=1);

return [
    'title' => 'IP to CIDR',
    'leetcode' => 751,
    'difficulty' => 'Med',
    'summary' => 'Convert the IP to a 32-bit number x. Repeatedly take the largest block 2^k that is aligned at x (x & −x) and does not exceed the remaining count; emit x/(32 − k), advance x and reduce n.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bits', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'ip-to-cidr',
    'related_session' => 'ip-to-cidr',
];

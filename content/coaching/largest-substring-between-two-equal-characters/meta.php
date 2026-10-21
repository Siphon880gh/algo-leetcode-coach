<?php
declare(strict_types=1);

return [
    'title' => 'Largest Substring Between Equal Characters: first index',
    'leetcode' => 1624,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: store each letter\'s first index; at each repeat, the gap is i − first − 1; return the max or −1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'largest-substring-between-two-equal-characters',
    'tags' => ['hash-map', 'string', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Max Achievable Transfer Requests: try all subsets',
    'leetcode' => 1601,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: at most 16 requests, so test every subset for zero net change per building and keep the largest size. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'maximum-number-of-achievable-transfer-requests',
    'tags' => ['bitmask', 'backtracking', 'enumeration', 'step-by-step'],
];

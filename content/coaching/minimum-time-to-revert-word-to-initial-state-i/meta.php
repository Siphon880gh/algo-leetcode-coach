<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Revert Word to Initial State I: suffix is a prefix',
    'leetcode' => 3029,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: try t = 1, 2, … until the kept suffix is a prefix or nothing is kept. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'minimum-time-to-revert-word-to-initial-state-i',
    'tags' => ['string', 'string-matching', 'hash-function', 'rolling-hash', 'step-by-step'],
];

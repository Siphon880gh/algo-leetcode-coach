<?php
declare(strict_types=1);

return [
    'title' => 'Remove Letter To Equalize Frequency: exactly one removal, present letters only, no shortcut',
    'leetcode' => 2423,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: always remove one letter, compare only letters still present, and try every removal rather than a rule on the counts. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'remove-letter-to-equalize-frequency',
    'tags' => ['hash-table', 'string', 'counting', 'step-by-step'],
];

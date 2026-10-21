<?php
declare(strict_types=1);

return [
    'title' => 'Split Into Max Unique Substrings: backtracking with a set',
    'leetcode' => 1593,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: try every next piece not yet used, recurse, undo; n ≤ 16 makes it fine; prune when used + remaining ≤ best. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'split-a-string-into-the-max-number-of-unique-substrings',
    'tags' => ['backtracking', 'hash-set', 'string', 'step-by-step'],
];

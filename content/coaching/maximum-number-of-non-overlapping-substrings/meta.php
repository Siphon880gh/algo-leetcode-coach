<?php
declare(strict_types=1);

return [
    'title' => 'Max Non-Overlapping Substrings: closed intervals + earliest end',
    'leetcode' => 1520,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: for each letter, expand [first, last] to cover all inner letters (invalid if one starts earlier); then pick by earliest end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-number-of-non-overlapping-substrings',
    'tags' => ['greedy', 'strings', 'intervals', 'step-by-step'],
];

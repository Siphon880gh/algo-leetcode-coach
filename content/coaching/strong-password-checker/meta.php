<?php
declare(strict_types=1);

return [
    'title' => 'Strong Password Checker: length cases, spend deletes on aaa runs first',
    'leetcode' => 420,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fewest inserts, deletes, and replaces so the password has length 6..20, a lower, an upper, a digit, and no three identical in a row. Split by length. Over 20, spend the forced deletes on runs by length mod 3 before replacing. "a" → 5. "aA1" → 3. "1337C0d3" → 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'strings', 'step-by-step'],
    'related_guide' => 'strong-password-checker',
];

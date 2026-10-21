<?php
declare(strict_types=1);

return [
    'title' => 'Remove Digit From Number to Maximize Result: earliest copy before a larger digit',
    'leetcode' => 2259,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: remove the first copy followed by a larger digit, fall back to the last copy, and never just take the first or last blindly. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'remove-digit-from-number-to-maximize-result',
    'tags' => ['string', 'greedy', 'enumeration', 'step-by-step'],
];

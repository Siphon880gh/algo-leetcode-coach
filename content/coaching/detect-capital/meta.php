<?php
declare(strict_types=1);

return [
    'title' => 'Detect Capital: count uppercase letters',
    'leetcode' => 520,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: capitals are correct if all uppercase, all lowercase, or only the first letter is. Count uppercase cnt: cnt == 0, cnt == len, or cnt == 1 with word[0] upper. "USA" → true. "FlaG" → false. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'step-by-step'],
    'related_guide' => 'detect-capital',
];

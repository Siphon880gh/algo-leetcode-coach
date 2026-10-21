<?php
declare(strict_types=1);

return [
    'title' => 'Break a Palindrome: first non-a in the left half',
    'leetcode' => 1328,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a single character cannot be broken; otherwise change the first non-a in the left half to a, or the last character to b if the left half is all a. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'break-a-palindrome',
    'tags' => ['greedy', 'strings', 'step-by-step'],
];

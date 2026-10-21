<?php
declare(strict_types=1);

return [
    'title' => 'Max Difference You Can Get From Changing an Integer: greedy digit swaps',
    'leetcode' => 1432,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: max = replace the first non-9 digit with 9 everywhere. Min = replace the leading digit with 1 if it is not 1, else the first later digit not in {0, 1} with 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'max-difference-you-can-get-from-changing-an-integer',
    'tags' => ['greedy', 'math', 'step-by-step'],
];

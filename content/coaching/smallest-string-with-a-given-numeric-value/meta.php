<?php
declare(strict_types=1);

return [
    'title' => 'Smallest String With Numeric Value: fill from the back',
    'leetcode' => 1663,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: from the last position backwards, place min(26, k − remaining) and subtract; the front keeps a\'s. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'smallest-string-with-a-given-numeric-value',
    'tags' => ['greedy', 'string', 'step-by-step'],
];

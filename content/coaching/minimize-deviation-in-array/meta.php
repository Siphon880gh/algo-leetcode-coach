<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Deviation: double odds, shrink the max',
    'leetcode' => 1675,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: double each odd so every value is at its maximum; repeatedly halve the current maximum while it is even, tracking the min. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'minimize-deviation-in-array',
    'tags' => ['heap', 'greedy', 'ordered-set', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Taps to Open to Water a Garden: greedy reach',
    'leetcode' => 1326,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: record for each left end the farthest reach, then sweep like Jump Game II, opening a tap each time the current coverage ends. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-number-of-taps-to-open-to-water-a-garden',
    'tags' => ['greedy', 'intervals', 'step-by-step'],
];

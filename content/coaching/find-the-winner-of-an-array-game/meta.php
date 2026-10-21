<?php
declare(strict_types=1);

return [
    'title' => 'Find the Winner of an Array Game: streak scan',
    'leetcode' => 1535,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the current winner and its streak; a larger value resets the streak to 1; return at streak k, or the maximum after one pass. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'find-the-winner-of-an-array-game',
    'tags' => ['simulation', 'arrays', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Candy Crush: mark everything before crushing',
    'leetcode' => 723,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: mark all runs in both directions first, crush the marks, drop each column with a write pointer, and repeat until nothing is marked. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'candy-crush',
    'tags' => ['simulation', 'matrix', 'two-pointers', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Process Tasks Using Servers: free heap, busy heap, jumping clock',
    'leetcode' => 1882,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: set time = max(time, j); if nothing is free, jump to the next free time; release, then assign the lightest free server. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'process-tasks-using-servers',
    'tags' => ['heap', 'simulation', 'step-by-step'],
];

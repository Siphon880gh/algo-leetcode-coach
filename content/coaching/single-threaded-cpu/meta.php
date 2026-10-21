<?php
declare(strict_types=1);

return [
    'title' => 'Single-Threaded CPU: sort by arrival, heap by length',
    'leetcode' => 1834,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort indices by enqueue time; heap available tasks by (processing time, index); jump time when idle; pop and run. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'single-threaded-cpu',
    'tags' => ['heap', 'sorting', 'simulation', 'step-by-step'],
];

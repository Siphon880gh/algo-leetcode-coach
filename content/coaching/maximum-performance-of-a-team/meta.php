<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Performance of a Team: efficiency floor plus speed heap',
    'leetcode' => 1383,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort by efficiency descending, keep the k largest speeds in a min-heap, and evaluate sum · current efficiency at each step. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-performance-of-a-team',
    'tags' => ['greedy', 'heap', 'sorting', 'step-by-step'],
];

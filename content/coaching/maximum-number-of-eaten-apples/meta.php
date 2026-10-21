<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Eaten Apples: earliest expiry heap',
    'leetcode' => 1705,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each day push (rot day, count); drop rotten or empty batches; eat one from the batch that rots first; continue after day n. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'maximum-number-of-eaten-apples',
    'tags' => ['heap', 'greedy', 'step-by-step'],
];

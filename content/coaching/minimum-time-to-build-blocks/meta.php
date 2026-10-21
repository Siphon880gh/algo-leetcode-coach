<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Build Blocks: pair the two smallest',
    'leetcode' => 1199,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: heapify the times, pop the two smallest a ≤ b, push split + b, and repeat until one value remains. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'minimum-time-to-build-blocks',
    'tags' => ['heap', 'greedy', 'step-by-step'],
];

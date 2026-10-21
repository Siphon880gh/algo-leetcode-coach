<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Halve Array Sum: biggest first, reuse halves',
    'leetcode' => 2208,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: always halve the current largest, put halves back into the heap, and stop once the cut reaches half. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'minimum-operations-to-halve-array-sum',
    'tags' => ['array', 'greedy', 'heap', 'step-by-step'],
];

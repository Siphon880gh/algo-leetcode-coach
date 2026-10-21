<?php
declare(strict_types=1);

return [
    'title' => 'Partition Labels: cut at the farthest last occurrence',
    'leetcode' => 763,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: record each letter\'s last index, extend the current part\'s end, and cut when the scan reaches it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'partition-labels',
    'tags' => ['greedy', 'two-pointers', 'hash-map', 'strings', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Longest Uploaded Prefix: a pointer, never rescan, a spare slot',
    'leetcode' => 2424,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track the prefix with a pointer instead of counting uploads, keep it between calls, and size the array with one spare slot. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'longest-uploaded-prefix',
    'tags' => ['design', 'hash-table', 'union-find', 'binary-indexed-tree', 'segment-tree', 'step-by-step'],
];

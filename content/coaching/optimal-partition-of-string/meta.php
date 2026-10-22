<?php
declare(strict_types=1);

return [
    'title' => 'Optimal Partition of String: any repeat, start the new piece with it, count from 1',
    'leetcode' => 2405,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: cut on any repeated letter in the piece, keep that letter in the new piece, and start counting at one piece. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'optimal-partition-of-string',
    'tags' => ['hash-table', 'string', 'greedy', 'step-by-step'],
];

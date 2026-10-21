<?php
declare(strict_types=1);

return [
    'title' => 'Snapshot Array: per-index history with binary search',
    'leetcode' => 1146,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep, for each index, a list of (snap_id, value) changes; snap returns the counter and increments it; get binary searches the last change with snap_id ≤ the query. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'snapshot-array',
    'tags' => ['design', 'binary-search', 'hash-table', 'arrays', 'step-by-step'],
];

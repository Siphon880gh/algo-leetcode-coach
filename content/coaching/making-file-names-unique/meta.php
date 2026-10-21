<?php
declare(strict_types=1);

return [
    'title' => 'Making File Names Unique: remembered next suffix',
    'leetcode' => 1487,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: map name → next k to try; for a taken name, advance k until name(k) is free, use it, and register both. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'making-file-names-unique',
    'tags' => ['hash-table', 'strings', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Subpath: binary search + double hash',
    'leetcode' => 1923,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: binary search the length; for each, intersect window hash sets across all paths. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Rolling Hash',
    'topic' => 'LeetCode · Rolling Hash',
    'related_guide' => 'longest-common-subpath',
    'tags' => ['rolling-hash', 'binary-search', 'suffix-array', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Destroy Sequential Targets: group by remainder, smallest value wins ties',
    'leetcode' => 2453,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: group targets by their remainder mod space rather than by value, and break ties by the smallest value, not the smallest remainder. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'destroy-sequential-targets',
    'tags' => ['array', 'hash-table', 'counting', 'step-by-step'],
];

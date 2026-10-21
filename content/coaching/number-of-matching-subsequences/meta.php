<?php
declare(strict_types=1);

return [
    'title' => 'Number of Matching Subsequences: buckets by waiting letter',
    'leetcode' => 792,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: put each word in the bucket of the letter it needs next, scan s once, and advance a bucket\'s words when its letter appears. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Map',
    'topic' => 'LeetCode · Hash Map',
    'related_guide' => 'number-of-matching-subsequences',
    'tags' => ['hash-map', 'strings', 'binary-search', 'step-by-step'],
];

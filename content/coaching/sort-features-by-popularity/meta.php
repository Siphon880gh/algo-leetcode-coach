<?php
declare(strict_types=1);

return [
    'title' => 'Sort Features by Popularity: count once per response',
    'leetcode' => 1772,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each response add 1 for every distinct word; then sort features by (−count, original index). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'sort-features-by-popularity',
    'tags' => ['hash-table', 'sorting', 'string', 'step-by-step'],
];
